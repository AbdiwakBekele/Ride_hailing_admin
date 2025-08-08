<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('national_id_url')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('national_id_url')->nullable(false)->change();
        });
    }
};