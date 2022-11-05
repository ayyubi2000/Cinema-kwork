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
            'post_comentaries', function (Blueprint $table) {
                $table->id();
                $table->foreignId('post_id')->constrained('posts')->onDelete('cascade')->onUpdate('cascade');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
                $table->foreignId('answear_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
                $table->text('content');
                $table->text('validation_message')->nullable();
                $table->string('status')->default(0);
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
        Schema::dropIfExists('postcomentarys');
    }
};