<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'posts', function (Blueprint $table) {
                $table->id();
                $table->text('photo_url');
                $table->string('title');
                $table->text('content');
                $table->text('validation_message')->nullable();
                $table->string('status')->default(0);
                $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade')->onUpdate('cascade');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};