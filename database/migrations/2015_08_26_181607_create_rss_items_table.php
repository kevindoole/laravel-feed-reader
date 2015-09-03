<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRssItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->string('link');
            $table->string('author');
            $table->string('categories');
            $table->datetime('pub_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rss_items');
    }
}
