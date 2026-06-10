<?php

// ============================================================
// Standalone migration script - BYPASSES Laravel middleware
// Ini tidak melewati session middleware, jadi bisa jalan
// meskipun tabel sessions belum ada.
// 
// HAPUS FILE INI SETELAH MIGRATION BERHASIL!
// ============================================================

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: application/json');

// Proteksi dengan secret key
if (($_GET['key'] ?? '') !== 'foodshare-migrate-2026') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Mengaktifkan Emulated Prepares. Ini adalah KUNCI untuk memperbaiki
// error PgBouncer 'current transaction is aborted' di Neon PostgreSQL.
$options = config('database.connections.pgsql.options', []);
$options[PDO::ATTR_EMULATE_PREPARES] = true;
config(['database.connections.pgsql.options' => $options]);

// Bypass Neon PgBouncer Pooler
$currentHost = config('database.connections.pgsql.host');
if ($currentHost && strpos($currentHost, '-pooler') !== false) {
    config(['database.connections.pgsql.host' => str_replace('-pooler', '', $currentHost)]);
}

$currentUrl = config('database.connections.pgsql.url');
if ($currentUrl && strpos($currentUrl, '-pooler') !== false) {
    config(['database.connections.pgsql.url' => str_replace('-pooler', '', $currentUrl)]);
}

// Bersihkan koneksi yang sudah terbuka agar config baru dipakai
\Illuminate\Support\Facades\DB::purge('pgsql');
\Illuminate\Support\Facades\DB::reconnect('pgsql');

try {
    // 1. Drop semua tabel secara manual dengan CASCADE untuk menghindari error migrate:fresh
    $tables = [
        'distributions', 'claims', 'food_items', 'registration_requests', 'articles',
        'sessions', 'password_reset_tokens', 'users', 
        'cache', 'cache_locks', 'jobs', 'job_batches', 'failed_jobs', 
        'migrations'
    ];
    
    foreach ($tables as $table) {
        \Illuminate\Support\Facades\DB::statement("DROP TABLE IF EXISTS \"$table\" CASCADE");
    }

    // 2. Jalankan migrate biasa (bukan fresh karena tabel sudah kita drop manual)
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    $output = \Illuminate\Support\Facades\Artisan::output();
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Tabel berhasil dihapus manual dan di-migrate ulang dengan Emulated Prepares!',
        'output' => $output
    ], JSON_PRETTY_PRINT);
} catch (\Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ], JSON_PRETTY_PRINT);
}
