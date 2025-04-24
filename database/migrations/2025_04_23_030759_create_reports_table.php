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
        Schema::create('report', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->string('ticket_number')->unique();
            $table->date('date');
            $table->time('open_time');
            $table->time('close_time');
            $table->enum('priority_level', ['low', 'medium', 'high'])->default('low');
            $table->enum('category', ['software', 'hardware', 'network', 'other'])->default('hardware');
            $table->longText('description');
            $table->enum('type_device', ['desktop', 'laptop', 'printer', 'other'])->default('printer');
            $table->enum('operation_system', ['windows', 'macos', 'linux', 'other'])->default('windows');
            $table->string('software_or_application');
            $table->longText('error_message')->nullable();
            $table->longText('step_taken')->nullable();
            $table->enum('ticket_status', ['on_progress','solved', 'callback', 'monitored', 'other'])->default('on_progress');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report');
    }
};
