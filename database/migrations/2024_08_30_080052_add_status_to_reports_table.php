<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  // database/migrations/xxxx_xx_xx_add_status_to_reports_table.php
public function up()
{
    Schema::table('laporans', function (Blueprint $table) {
        $table->string('status')->default('pending');
    });
}

public function down()
{
    Schema::table('laporans', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
