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
        Schema::create('function_type_item', function (Blueprint $table) {
            $table->id();
            $table->integer('function_type_id');
            $table->integer('item_id');
            // $table->date('date')->nullable();
            // $table->string('location')->nullable();
            // $table->string('event_type')->nullable();
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
        Schema::dropIfExists('function_type_item');
    }
};
