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
        Schema::create('characters', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name", 100);
            $table->integer("height")->length(4);
            $table->integer("weight")->length(4);
            $table->string("image_path", 100);
            $table->integer("tribe_id")->length(2);
            $table->integer("season_id")->length(2);
            $table->text("content");
            $table->integer("attack")->length(2);
            $table->integer("defense")->length(2);
            $table->integer("ability")->length(2);
            $table->integer("popularity")->length(2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
};
