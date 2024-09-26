<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id',11);
            $table->string('title',255);
            $table->string('slug',255);
            $table->text('meta_title');
            $table->text('meta_keywords');
            $table->text('meta_description');
            $table->text('short_description');                                
            $table->longText('key_features');  
            $table->string('featured_image',255);            
            $table->string('specificationimage',255);
            $table->longText('description');
            $table->string('spec_sheet',255);
            $table->tinyInteger('enabled');
            $table->integer('view_count');
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
        Schema::dropIfExists('products');
    }
}
