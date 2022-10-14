<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plant_id');
            $table->unsignedBigInteger('intervention_classification_id');
            $table->date('date');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('plant_id')->references('id')->on('plants');
            $table->foreign('intervention_classification_id')->references('id')->on('intervention_classifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('plant_id');
            $table->dropConstrainedForeignId('intervention_classification_id');
        });

        Schema::dropIfExists('interventions');
    }
}
