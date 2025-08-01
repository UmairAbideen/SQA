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
        Schema::create('ramp_inspection_findings', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('code')->nullable(); // Code of the finding
            $table->string('category')->nullable(); // Category of the finding
            $table->text('finding')->nullable(); // Detailed description of the finding
            $table->string('attachment')->nullable(); // Attachment related to the finding
            $table->string('status')->nullable(); // Current status of the finding
            $table->string('closed_by')->nullable(); // Person who closed the finding
            $table->foreignId('ramp_inspection_id')->references('id')->on('ramp_inspections')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps(); // Created at and updated at timestamps
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
