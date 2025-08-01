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
            $table->string('hf')->nullable();
            $table->string('op')->nullable();
            $table->string('cdccl')->nullable();
            $table->string('tt')->nullable();
            $table->string('sms')->nullable();
            $table->string('ewis')->nullable();
            $table->string('al')->nullable();
            $table->string('at_1')->nullable();
            $table->string('at_2')->nullable();
            $table->string('at_3')->nullable();
            $table->string('at_4')->nullable();

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
