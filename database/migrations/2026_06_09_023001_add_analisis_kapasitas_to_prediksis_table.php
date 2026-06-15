<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('prediksis', function (Blueprint $table) {
            $table->decimal('pendapatan_bulanan', 15, 2)->nullable();
            $table->decimal('dsr_saat_ini', 8, 4)->nullable();
            $table->decimal('sisa_kapasitas_dsr', 8, 4)->nullable();
            $table->decimal('limit_kemampuan_bayar', 15, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('prediksis', function (Blueprint $table) {
            $table->dropColumn(['pendapatan_bulanan', 'dsr_saat_ini', 'sisa_kapasitas_dsr', 'limit_kemampuan_bayar']);
        });
    }
};