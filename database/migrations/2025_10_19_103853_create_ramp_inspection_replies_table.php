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
        Schema::create('ramp_inspection_replies', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->text('reply')->nullable(); // Reply content
            $table->string('reply_by')->nullable(); // Person who gave the reply
            $table->text('remarks')->nullable(); // Additional remarks
            $table->string('remarks_by')->nullable(); // Person who provided the remarks
            $table->string('attachment')->nullable(); // Attachment related to the reply
            $table->string('draft')->nullable(); // Current draft status
            $table->string('status')->nullable(); // Current status of the reply
            $table->foreignId('ramp_inspection_finding_id')->references('id')->on('ramp_inspection_findings')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ramp_inspection_replies');
    }
};
