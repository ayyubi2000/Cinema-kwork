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
        Schema::create('latest_new_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('latest_new_id')->constrained('latest_news')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('latest_new_tag');
    }
};