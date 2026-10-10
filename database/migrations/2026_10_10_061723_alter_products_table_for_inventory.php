<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('sku')->unique()->after('id')->nullable();
            $table->foreignId('category_id')->nullable()->after('sku')->constrained()->restrictOnDelete();
        });

        // Hapus kolom kategori yang lama (string) jika diinginkan,
        // Tapi untuk menghindari masalah dengan data lama saat migrate, 
        // lebih baik kita pertahankan saat ini atau drop jika melakukan migrate:fresh
        // Namun karena instruksinya fresh migration:
        if (Schema::hasColumn('products', 'category')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['sku', 'category_id']);
            $table->string('category')->nullable();
        });
    }
};
