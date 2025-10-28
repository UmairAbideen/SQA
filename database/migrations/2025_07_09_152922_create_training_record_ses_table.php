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
        Schema::create('training_record_ses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade')->onUpdate('cascade');

            // Changed all from boolean to string (text input)
            $table->date('hf')->nullable();
            $table->date('op')->nullable();
            $table->date('cdccl')->nullable();
            $table->date('tt')->nullable();
            $table->date('sms')->nullable();
            $table->date('ewis')->nullable();
            $table->date('al')->nullable();
            $table->date('at_1')->nullable();
            $table->date('at_2')->nullable();
            $table->date('at_3')->nullable();
            $table->date('at_4')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_record_ses');
    }
};
