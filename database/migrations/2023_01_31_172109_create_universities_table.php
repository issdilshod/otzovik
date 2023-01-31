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
        Schema::create('universities', function (Blueprint $table) {
            $table->string('id');

            $table->string('user_id')->nullable();

            $table->integer('number')->autoIncrement();

            $table->string('name')->nullable();
            $table->text('description')->nullable();

            $table->string('logo')->nullable();

            $table->string('slug')->nullable();

            $table->tinyInteger('status');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('universities');
    }
};
