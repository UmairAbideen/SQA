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
        Schema::create('audit_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_finding_id')->references('id')->on('audit_findings')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->date('date')->nullable(); // Date of reply
            $table->time('time')->nullable(); // Time of reply
            $table->text('reply')->nullable(); // Reply content
            $table->text('root_cause')->nullable(); // Root cause analysis
            $table->text('corrective_action')->nullable(); // Corrective action taken
            $table->text('preventive_action')->nullable(); // Preventive measures
            $table->string('reply_by')->nullable(); // Person who replied
            $table->string('attachment')->nullable(); // Attachment file path
            $table->text('attachment_detail')->nullable(); // Details of the attachment
            $table->date('target_date_after_extension')->nullable(); // Target date after extension
            $table->text('qa_remarks')->nullable(); // QA remarks
            $table->string('closed_by')->nullable(); // Person who closed the issue
            $table->text('final_remarks')->nullable(); // Final remarks
            $table->string('status')->nullable(); // Status of the reply
            $table->date('closing_date')->nullable(); // Closing date of the reply
            $table->text('closing_remarks')->nullable(); // Closing remarks
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
