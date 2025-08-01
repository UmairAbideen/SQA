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
        Schema::create('ramp_inspections', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->date('date'); // Date of the inspection
            $table->time('inspection_time')->nullable(); // Time of inspection
            $table->string('aircraft_reg')->nullable(); // Aircraft registration
            $table->string('aircraft_type')->nullable(); // Aircraft type
            $table->string('arrival_station')->nullable(); // Arrival station
            $table->string('destination')->nullable(); // Destination
            $table->string('flight_no')->nullable(); // Flight number
            $table->string('bay_no')->nullable(); // Bay number
            $table->string('inspection_ref_no')->nullable(); // Inspection reference number
            $table->string('inspection_type')->nullable(); // Type of inspection
            $table->string('inspector')->nullable(); // Inspector name
            $table->string('status')->nullable(); // Inspection status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
