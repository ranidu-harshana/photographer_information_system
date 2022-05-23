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
        Schema::create('customer_function_type', function (Blueprint $table) {
            $table->id();
            $table->integer('function_type_id');
            $table->integer('customer_id');
            $table->date('date')->nullable();
            $table->string('location')->nullable();
            $table->string('event_type')->nullable();
            $table->date('postponed_date')->nullable();
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
        Schema::dropIfExists('customer_function_type');
    }
};
