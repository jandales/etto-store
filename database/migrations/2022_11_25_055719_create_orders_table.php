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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();          
            $table->string('number')->unique(); 
            $table->double('tax_total')->default(0);
            $table->double('gross_total')->default(0);
            $table->double('net_total')->default(0);

            $table->integer('shipping_method_id')->nullable();
            $table->integer('shipping_charge')->unsigned();

            $table->integer('coupon_id')->nullable();
            $table->double('coupon_amount')->default(0);

            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            //foreignid  
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('shipping_id')->references('id')->on('addresses');
            $table->foreignId('billing_id')->references('id')->on('addresses');

            $table->string('status')->nullable(); 

            $table->softDeletes();          
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
};
