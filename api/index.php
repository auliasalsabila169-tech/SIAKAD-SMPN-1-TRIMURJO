<?php

// Inisialisasi folder storage di /tmp untuk lingkungan serverless Vercel
$storageDirs = [
    '/tmp/storage/app',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
];

foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// Salin database SQLite bawaan ke /tmp jika belum ada
if (!file_exists('/tmp/database.sqlite')) {
    $sourceDb = __DIR__ . '/../database/database.sqlite';
    if (file_exists($sourceDb)) {
        @copy($sourceDb, '/tmp/database.sqlite');
    }
}

require __DIR__ . '/../public/index.php';
