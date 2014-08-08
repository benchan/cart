<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::create('items', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name',255);
            $table->string('code',100);
            $table->integer('price');
            $table->string('type',50);
            $table->timestamps();
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
        Schema::table('items', function(Blueprint $table)
    {
        //
    });
    }

}
