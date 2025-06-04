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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            //sku_id foreign key table skus
            $table->foreignId('sku_id')->constrained('skus')->onDelete('cascade');
            //event_id foreign key table events
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            //ticket_code
            $table->string('ticket_code');
            //ticket_date
            $table->date('ticket_date')->nullable();
            //status default available enum available, booked, redeemed
            $table->enum('status', ['available', 'booked', 'sold', 'redeemed'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
