<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionalDisplaySolutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professional_display_solution', function (Blueprint $table) {
            $table->bigIncrements('id',20);
            $table->bigInteger('solution_id',11);
            $table->string('title',255);
            $table->string('slug',255);
            $table->text('meta_title');
            $table->text('meta_keywords');
            $table->text('meta_description');
            $table->text('short_description');
            $table->longText('content');
            $table->string('image',255);
            $table->string('banner',255);    
            $table->string('banner_title',255);
            $table->text('banner_short_description');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('professional_display_solution');
    }
}
