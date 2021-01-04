<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->enum('sexe',['Masculin','Feminin'])->default('Masculin');
            $table->string('email');
            $table->string('contact')->nullable();
            $table->string('pays')->nullable();
            $table->string('region')->nullable();
            $table->string('ville')->nullable();
            $table->string('adresse')->nullable();
            $table->string('identity')->nullable();
            $table->string('selfie')->nullable();
            $table->string('image_justificative')->nullable();
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
        Schema::dropIfExists('personnes');
    }
}
