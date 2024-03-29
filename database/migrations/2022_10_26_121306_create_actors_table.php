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
            'actors', function (Blueprint $table) {
                $table->id();
                $table->string('nic_name');
                $table->string('name');
                $table->string('address');
                $table->json('birthday');
                $table->json('carrera');
                $table->string('growth');
                $table->text('url');
                $table->text('photo_url');
                $table->json('fact');
                $table->foreignId('country_id')->constrained('countries');
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
        Schema::dropIfExists('actors');
    }
};