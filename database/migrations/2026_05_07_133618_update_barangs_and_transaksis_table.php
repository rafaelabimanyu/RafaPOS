<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Update Barangs: Add kategori_id, remove old kategori string
        Schema::table('barangs', function (Blueprint $table) {
            $table->foreignId('kategori_id')->nullable()->after('nama')->constrained('kategoris')->onDelete('set null');
            // We'll keep the old 'kategori' column for now to migrate data, or just drop it if we're starting fresh
            // But let's be safe and just add the new one.
        });

        // Update Transaksis: Add discount fields
        Schema::table('transaksis', function (Blueprint $table) {
            $table->decimal('diskon', 15, 2)->default(0)->after('total_harga');
            $table->decimal('total_akhir', 15, 2)->default(0)->after('diskon');
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropColumn(['diskon', 'total_akhir']);
        });

        Schema::table('barangs', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }
};
