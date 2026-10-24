<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('laporan_pengaduans', function (Blueprint $table) {
            $table->foreignId('lokasi_id')
                ->nullable()
                ->after('kategori_id')
                ->constrained('lokasis')
                ->nullOnDelete();

            $table->foreignId('sarana_id')
                ->nullable()
                ->after('lokasi_id')
                ->constrained('saranas')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_pengaduans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('sarana_id');
            $table->dropConstrainedForeignId('lokasi_id');
        });
    }
};
