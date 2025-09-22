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
        Schema::create('usages', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('company_id')->unique();
            $table->integer('messages_used')->default(0);
            $table->integer('api_calls_used')->default(0);
            $table->timestamps();

            
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usages');
    }
};
