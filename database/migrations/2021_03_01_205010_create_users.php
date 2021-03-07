<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->unsignedBigInteger('rol_id');
            $table->string('name');
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->string('phone');
            $table->string('adress');
            $table->string('gender');
            $table->string('document_id');
            $table->date('birthdate');
            $table->string('marital_status');
            $table->string('title');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('whatsapp');
            $table->string('instagram');
            $table->string('pinterest');
            $table->string('youtube');
            $table->string('linkedin');
            $table->string('picture');
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
        Schema::dropIfExists('users');
    }
}
