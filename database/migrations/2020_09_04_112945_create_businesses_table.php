<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('businesses', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('user_id');
			$table->string('name')->notNullable();
			$table->string('phone')->unique();
			$table->string('email')->unique();
			$table->integer('cat_id')->nullable();
			$table->integer('subcat_id')->nullable();
			$table->text('address')->nullable();
			$table->decimal('latitude')->nullable();
			$table->decimal('logitude')->nullable();
			$table->text('opening_hours')->nullable();
			$table->text('opening_day')->nullable();
			$table->longText('services_description')->nullable();
			$table->text('fb_link')->nullable();
			$table->text('ig_link')->nullable();
			$table->text('twitter_link')->nullable();
			$table->text('add_promotions')->nullable();
			$table->text('web_link')->nullable();
			$table->boolean('dm')->nullable();
			$table->boolean('phone_call')->nullable();
			$table->boolean('home_delivery')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('businesses');
	}
}