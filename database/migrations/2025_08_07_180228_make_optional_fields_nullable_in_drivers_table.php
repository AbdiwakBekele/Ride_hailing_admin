<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('national_id_url')->nullable()->change();
            $table->string('license_url')->nullable()->change();
            $table->string('insurance_url')->nullable()->change();
            $table->string('picture_url')->nullable()->change();
            $table->string('national_id_status')->nullable()->change();
            $table->string('license_status')->nullable()->change();
            $table->string('insurance_status')->nullable()->change();
            $table->string('picture_status')->nullable()->change();
            $table->string('national_id_number')->nullable()->change();
            $table->string('license_number')->nullable()->change();
            $table->string('location')->nullable()->change();
            $table->boolean('is_available')->default(false)->change();
        });
    }

    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('national_id_url')->nullable(false)->change();
            $table->string('license_url')->nullable(false)->change();
            $table->string('insurance_url')->nullable(false)->change();
            $table->string('picture_url')->nullable(false)->change();
            $table->string('national_id_status')->nullable(false)->change();
            $table->string('license_status')->nullable(false)->change();
            $table->string('insurance_status')->nullable(false)->change();
            $table->string('picture_statu')->nullable(false)->change();
            $table->string('national_id_number')->nullable(false)->change();
            $table->string('license_number')->nullable(false)->change();
            $table->string('location')->nullable(false)->change();
            $table->boolean('is_available')->default(false)->change();
        });
    }
};