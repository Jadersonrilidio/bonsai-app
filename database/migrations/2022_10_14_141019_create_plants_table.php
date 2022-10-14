<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('plant_classification_id');
            $table->unsignedBigInteger('bonsai_style_id');
            $table->string('name', 128);
            $table->string('specimen', 128)->nullable();
            $table->date('age')->nullable();
            $table->text('description')->nullable();
            $table->string('main_picture')->nullable();
            $table->float('height', 8, 2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('plant_classification_id')->references('id')->on('plant_classifications');
            $table->foreign('bonsai_style_id')->references('id')->on('bonsai_styles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('plant_classification_id');
            $table->dropConstrainedForeignId('bonsai_style_id');
        });

        Schema::dropIfExists('plants');
    }
}
