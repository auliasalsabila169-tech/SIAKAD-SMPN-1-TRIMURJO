<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Otomatis import database awal jika menggunakan MySQL kosong (misal di Railway)
        try {
            $lockFile = storage_path('framework/siakad_db_ready.lock');
            if (!file_exists($lockFile)) {
                if (config('database.default') === 'mysql') {
                    if (!Schema::hasTable('users')) {
                        $sqlPath = base_path('siakad_smpn1_trimurjo.sql');
                        if (file_exists($sqlPath)) {
                            DB::unprepared(file_get_contents($sqlPath));
                        }
                    }
                }
                @file_put_contents($lockFile, date('Y-m-d H:i:s'));
            }
        } catch (\Throwable $e) {
            // Abaikan agar aplikasi tidak crash jika DB belum siap
        }
    }
}
