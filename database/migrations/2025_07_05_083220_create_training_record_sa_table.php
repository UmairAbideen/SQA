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
            $table->date('pcca_regulation')->nullable();
            $table->date('mcm')->nullable();
            $table->date('amp')->nullable();
            $table->date('reliability')->nullable();
            $table->date('ad_sb')->nullable();
            $table->date('maintenance')->nullable();
            $table->date('record_keeping')->nullable();
            $table->date('quality_monitoring')->nullable();
            $table->date('level1_training')->nullable();
            $table->date('fuel_tank')->nullable();
            $table->date('quality_auditor')->nullable();
            $table->date('ramp_insp')->nullable();
            $table->date('engine_health')->nullable();
            $table->date('hf')->nullable();
            $table->date('sms')->nullable();
            $table->date('ewis')->nullable();
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
