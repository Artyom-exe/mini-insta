<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoryLikesTable extends Migration
{
    public function up()
    {
        Schema::create('story_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('story_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('story_likes');
    }
}
