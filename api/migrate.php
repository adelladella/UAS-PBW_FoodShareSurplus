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

// Bypass Neon PgBouncer Pooler khusus untuk proses migrasi ini
// Mengubah host dari '...-pooler.c-8...' menjadi '....c-8...'
$currentHost = config('database.connections.pgsql.host');
if (strpos($currentHost, '-pooler') !== false) {
    $directHost = str_replace('-pooler', '', $currentHost);
    config(['database.connections.pgsql.host' => $directHost]);
}

// Jika menggunakan DB_URL, kita juga perlu membersihkannya
$currentUrl = config('database.connections.pgsql.url');
if ($currentUrl && strpos($currentUrl, '-pooler') !== false) {
    $directUrl = str_replace('-pooler', '', $currentUrl);
    config(['database.connections.pgsql.url' => $directUrl]);
}

// Bersihkan koneksi yang sudah terbuka agar config baru dipakai
\Illuminate\Support\Facades\DB::purge('pgsql');
\Illuminate\Support\Facades\DB::reconnect('pgsql');

try {
    // Gunakan migrate:fresh karena mungkin ada tabel yang terbuat setengah dari percobaan sebelumnya
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
    $output = \Illuminate\Support\Facades\Artisan::output();
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Migration fresh berhasil dijalankan! Semua tabel sudah dibuat.',
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
