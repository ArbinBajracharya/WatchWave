<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('genre')->nullable();
            $table->string('country')->nullable();
            $table->string('cast')->nullable();
            $table->string('language')->nullable();
            $table->string('type')->nullable();
            $table->string('verse')->nullable();
            $table->string('director')->nullable();
            $table->string('relase_date')->nullable();
            $table->string('duration')->nullable();
            $table->string('picture')->nullable();
            $table->string('video')->nullable();
            $table->string('trailer')->nullable();
            $table->integer('view')->default(0)->nullable();
            $table->text('description')->nullable();
            $table->string('rating')->nullable();
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('video');
    }
}
