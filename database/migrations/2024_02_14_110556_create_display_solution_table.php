<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisplaySolutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display_solution', function (Blueprint $table) {
            $table->bigIncrements('id',11);
            $table->string('title',255);
            $table->string('slug',255);
            $table->text('meta_title');
            $table->text('meta_keywords');
            $table->text('meta_description');
            $table->string('image',255);
            $table->text('short_description');
            $table->longText('content');   
            $table->bigIncrements('menu_id',11);  
            $table->string('banner',255);    
            $table->string('banner_title',255);
            $table->text('banner_short_description');
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
        Schema::dropIfExists('display_solution');
    }
}
