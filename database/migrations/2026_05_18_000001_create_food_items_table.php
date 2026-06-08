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
        Schema::create('food_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained('users')->onDelete('cascade');
            $table->string('food_name');
            $table->string('category');
            $table->integer('quantity');
            $table->string('unit');
            $table->text('description')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->text('pickup_address')->nullable();
            $table->string('status')->default('available'); // available, claimed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_items');
    }
};
