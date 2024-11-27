<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
          $table->id();
          $table->string('message');
          $table->json('images')->nullable();
          $table->integer('likes')->default(0);
          $table->foreignId('topic_id')->constrained()->onDelete('cascade');
          $table->foreignId('user_id')->constrained()->onDelete('cascade');
          $table->timestamps();
       });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
