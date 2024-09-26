<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseStudyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_study', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',255);
            $table->string('slug',255);
            $table->string('client_name',255);
            $table->string('project_year',255);
            $table->string('project_type',255);
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('short_description');
            $table->string('image',255);
            $table->longText('content'); 
            $table->tinyInteger('active');            
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
        Schema::dropIfExists('case_study');
    }
}
