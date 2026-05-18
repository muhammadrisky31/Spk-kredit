<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('prediksis', function (Blueprint $table) {
            $table->decimal('limit_rekomendasi', 15, 2)->nullable();
            $table->json('justifikasi')->nullable();
            $table->decimal('skor_risiko', 5, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('prediksis', function (Blueprint $table) {
            $table->dropColumn(['limit_rekomendasi', 'justifikasi', 'skor_risiko']);
        });
    }
};