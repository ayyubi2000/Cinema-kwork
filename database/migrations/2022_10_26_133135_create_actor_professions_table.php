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
        Schema::create('actor_profession', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profession_id')->constrained('professions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('actor_id')->constrained('actors')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('actor_professions');
    }
};