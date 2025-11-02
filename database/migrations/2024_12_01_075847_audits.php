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
        Schema::create('audits', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('organization')->nullable(); // Organization Name
            $table->string('audit_reference')->nullable(); // Reference for the Audit
            $table->string('audit_type')->nullable(); // Type of Audit
            $table->string('section')->nullable(); // Section involved in the audit
            $table->string('audit_location')->nullable(); // Location of the audit
            $table->string('status')->nullable();
            $table->date('audit_date')->nullable(); // Date of the audit
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
