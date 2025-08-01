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
        Schema::create('audit_findings', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('audit_id')->references('id')->on('audits')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->string('rule_reference')->nullable(); // Rule reference
            $table->text('finding')->nullable(); // Finding details
            $table->date('target_dates')->nullable(); // Target dates
            $table->string('finding_number')->nullable(); // Finding #
            $table->string('finding_level')->nullable(); // Finding level
            $table->boolean('repeated_finding'); // Repeated finding (Yes/No)
            $table->string('nature_of_finding')->nullable(); // Nature of finding
            $table->date('validity_date')->nullable(); // Validity date
            $table->string('auditor')->nullable(); // Auditor name
            $table->string('status'); // Status
            $table->timestamps(); // Created_at and Updated_at
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
