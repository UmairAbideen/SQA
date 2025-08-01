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
        Schema::create('training_record_sa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade')->onUpdate('cascade');
            $table->string('pcca_regulation')->nullable();
            $table->string('mcm')->nullable();
            $table->string('amp')->nullable();
            $table->string('reliability')->nullable();
            $table->string('ad_sb')->nullable();
            $table->string('maintenance')->nullable();
            $table->string('record_keeping')->nullable();
            $table->string('quality_monitoring')->nullable();
            $table->string('level1_training')->nullable();
            $table->string('fuel_tank')->nullable();
            $table->string('quality_auditor')->nullable();
            $table->string('ramp_insp')->nullable();
            $table->string('engine_health')->nullable();
            $table->string('hf')->nullable();
            $table->string('sms')->nullable();
            $table->string('ewis')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_record_sa');
    }
};
