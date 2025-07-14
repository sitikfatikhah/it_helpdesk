<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
   public function up(): void
{
    // Table: Ticket
    Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('department_id')->constrained()->onDelete('cascade');
        $table->string('ticket_number')->unique();
        $table->date('date');
        $table->time('open_time');
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

    // Table: Posts
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->text('content');
        $table->timestamps();
    });
}

public function down(): void
{
    // Drop foreign keys terlebih dahulu agar tidak error saat drop table
    Schema::table('tickets', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
    });

    Schema::table('posts', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
    });

    // Drop tabel-tabel
    Schema::dropIfExists('posts');
    Schema::dropIfExists('tickets');
}

};
