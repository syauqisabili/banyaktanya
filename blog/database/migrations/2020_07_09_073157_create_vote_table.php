<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('upvote');
            $table->unsignedInteger('downvote');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pertanyaan_id');
            $table->unsignedBigInteger('jawaban_id');

            //foreign key ke tabel users
            $table  ->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

            //foreign key ke tabel pertanyaan
            $table  ->foreign('pertanyaan_id')
                    ->references('id')
                    ->on('pertanyaan')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

             //foreign key ke tabel jawaban
            $table  ->foreign('jawaban_id')
                    ->references('id')
                    ->on('jawaban')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote');
    }
}
