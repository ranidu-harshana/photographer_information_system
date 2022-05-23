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
            
            $table->string('bill_nulber')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('mob_no1')->nullable();
            $table->string('mob_no2')->nullable();
            
            $table->double('total_payment')->nullable();
            $table->double('discount')->nullable();
            $table->double('advance_payment')->nullable();
            
            $table->tinyInteger('status')->default(1);
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
