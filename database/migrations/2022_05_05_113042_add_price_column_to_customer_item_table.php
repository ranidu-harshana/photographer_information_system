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
        Schema::table('customer_item', function (Blueprint $table) {
            $table->double('item_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->tinyInteger('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_item', function (Blueprint $table) {
            $table->dropColumn('item_price');
            $table->dropColumn('quantity');
            $table->dropColumn('status');
        });
    }
};
