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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('productName');
            $table->string('productCategory');
            $table->string('productImage')->nullable();
            $table->longText('ProductDescription');
            $table->string('manufacturerName')->nullable();
            $table->string('status');
            $table->decimal('productPrice', 10, 2);
            $table->decimal('discountPrice', 10, 2);
            $table->string('quantity')->nullable();
            $table->string('status1')->default(0);
            $table->string('warranty')->nullable();
            $table->string('featuredProduct')->nullable();
            $table->string('customFields')->nullable();
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
        
    }
};
