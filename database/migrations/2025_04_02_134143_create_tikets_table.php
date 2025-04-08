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
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade'); // Corrected 'CASECADE' to 'cascade'
            $table->string('priority_level');
            $table->string('category');
            $table->string('type_device');
            $table->string('operation_system');
            $table->string('software_or_apps');
            $table->text('keluhan'); // Changed to 'text' since complaints might be longer
            $table->text('step_taken')->nullable(); // Changed to 'text' for longer text
            $table->string('status_tiket');
            $table->timestamps(); // Removed custom column name for created_at, 'timestamps' will automatically create 'created_at' and 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tikets');
    }
};
