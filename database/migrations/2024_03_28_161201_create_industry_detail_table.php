<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustryDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('industry_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('industry_id',11);
            $table->string('image',255)->nullable();
            $table->string('title',255)->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('status');
            $table->bigInteger('sort_order',11);
            $table->enum('position', ['left', 'right']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
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
        Schema::dropIfExists('industry_detail');
    }
}
