<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members');
            
            $table->string('tran_id')->unique();
            $table->string('gateway_tran_id')->nullable(); 
         
            $table->float('discount_amount'); 
            $table->float('gross_amount'); 
            $table->float('shipping_amount');
            $table->float('net_amount');   
            $table->float('total_amount'); 

            $table->string('status');

            $table->string('payment_type')->nullable();
            $table->string('payment_method');
            $table->integer('payment_status');

            $table->timestamp('payment_time')->nullable();
            $table->date('payment_date')->nullable();
            $table->integer('payment_year')->nullable();
            $table->integer('payment_month')->nullable();
            $table->integer('payment_day')->nullable();

            $table->string('shipping_name');
            $table->string('shipping_phone');
            $table->string('district');
            $table->string('upazila');
            $table->string('union');
            $table->text('address');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
