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

try {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    $output = \Illuminate\Support\Facades\Artisan::output();
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Migration berhasil dijalankan!',
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
