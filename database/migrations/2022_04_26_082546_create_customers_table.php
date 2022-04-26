<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('function_type_id');
            $table->string('bill_nulber')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('mob_no1')->nullable();
            $table->string('mob_no2')->nullable();
            $table->date('wedding_date')->nullable();
            $table->string('wedding_location')->nullable();
            $table->string('home_com_date')->nullable();
            $table->string('home_com_location')->nullable();
            $table->string('event_type')->nullable();
            $table->string('event_date')->nullable();
            $table->string('event_location')->nullable();
            $table->string('photo_shoot_date')->nullable();
            $table->string('photo_shoot_location')->nullable();
            $table->double('total_payment')->nullable();
            $table->double('discount')->nullable();
            $table->double('advance_payment')->nullable();
            $table->double('total_package_price')->nullable();
            $table->double('total_item_price')->nullable();
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
        Schema::dropIfExists('customers');
    }
};
