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
        Schema::create('studios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('photo_url');
            $table->json('establition_date');
            $table->string('founders');
            $table->foreignId('country_id')->constrained('countries');
            $table->string('employees_amount');
            $table->json('profit');
            $table->json('capitalization');
            $table->text('web_site_url');
            $table->json('history');
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
        Schema::dropIfExists('studios');
    }
};