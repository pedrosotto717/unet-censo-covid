<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DiseasesAnnouncement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diseases', function (Blueprint $table) {
            $table->id();
            $table->boolean('attended_in_hospital')->default(true);
            $table->string('additional_symptoms')->nullable();

            $table->boolean('fever')->default(false);
            $table->boolean('skin_rashes')->default(false);
            $table->boolean('cough')->default(false);
            $table->boolean('muscle_ache')->default(false);
            $table->boolean('headache')->default(false);
            $table->boolean('vomiting')->default(false);

            $table->enum('disease_type', ['covid-19', 'covid-con-variacion', 'viruela-del-mono'])->default('covid-19');
            $table->foreignId('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('diseases');
    }
}
