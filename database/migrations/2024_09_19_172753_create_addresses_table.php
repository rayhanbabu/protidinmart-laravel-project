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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members');
            
            $table->string('name');  
            $table->string('phone'); 
            $table->string('alternative_phone')->nullable(); 
            $table->string('district_id'); 
            $table->string('upazila_id');  
            $table->string('union_id');      
            $table->text('address');      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
