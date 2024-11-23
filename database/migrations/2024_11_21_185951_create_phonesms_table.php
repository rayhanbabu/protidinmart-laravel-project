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
        Schema::create('phonesms', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('status')->default(0);
            $table->string('verify_status')->default(0);
            $table->integer('otp');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phonesms');
    }
};
