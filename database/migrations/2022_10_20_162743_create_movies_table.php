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
            'movies', function (Blueprint $table) {
                $table->id();
                $table->json('title');
                $table->text('original_title');
                $table->text('photo_url');
                $table->string('top');
                $table->string('type');
                $table->string('age_limit');
                $table->string('production_year');
                $table->string('slogan');
                $table->string('director');
                $table->string('scenario');
                $table->string('producer');
                $table->string('operator');
                $table->string('composer');
                $table->string('painter');
                $table->string('assembly');
                $table->json('world_premiere');
                $table->string('mpaa_rating');
                $table->string('duration');
                $table->foreignId('country_id')->constrained('countries');
                $table->foreignId('category_id')->constrained('categories');
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
        Schema::dropIfExists('movies');
    }
};