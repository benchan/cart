<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('orders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('last_name',255);
            $table->string('first_name',255);
            $table->string('last_name_kana',255);
            $table->string('first_name_kana',255);
            $table->string('zip',7);
            $table->string('prefecture',10);
            $table->string('city',100);
            $table->string('address1',255);
            $table->string('address2',255);
            $table->string('tel',12);
            $table->string('email',255);
            $table->string('gender',10);
            $table->string('birth_year',4);
            $table->string('birth_month',2);
            $table->string('birth_day',2);

            $table->tinyInteger('addition_type');

            $table->string('addition_last_name',255);
            $table->string('addition_first_name',255);
            $table->string('addition_last_name_kana',255);
            $table->string('addition_first_name_kana',255);
            $table->string('addition_zip',7);
            $table->string('addition_prefecture_name',10);
            $table->string('addition_city',100);
            $table->string('addition_address_1',255);
            $table->string('addition_address_2',255);
            $table->string('addition_tel_1',12);
            $table->string('payment',50);
            
            $table->string('code',50);
            $table->string('item_name',50);
            $table->integer('num');
            $table->string('order_type',50);
            $table->integer('price');

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

        Schema::dropIfExists('orders');
	}

}
