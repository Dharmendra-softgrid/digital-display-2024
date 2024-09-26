<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_room', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('title',255);
            $table->string('slug',255);
            $table->text('meta_title');
            $table->text('meta_keywords');
            $table->text('meta_description');
            $table->string('image',255);                       
            $table->string('short_description',100);
            $table->longText('content');
            $table->string('publisher',255);
            $table->string('link',255);
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
        Schema::dropIfExists('news_room');
    }
}
