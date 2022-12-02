<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->integer("height")->length(4)->nullable()->change();
            $table->integer("weight")->length(4)->nullable()->change();
            $table->string("image_path", 100)->nullable()->change();
            $table->text("content")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->integer("height")->length(4)->nullable(false)->change();
            $table->integer("weight")->length(4)->nullable(false)->change();
            $table->string("image_path", 100)->nullable(false)->change();
            $table->text("content")->nullable(false)->change();
        });
    }
};
