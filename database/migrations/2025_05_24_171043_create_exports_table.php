<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->id();

            // Opsional: user yang melakukan ekspor
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Kelas exporter yang digunakan
            $table->string('exporter');

            // Informasi progress ekspor
            $table->unsignedInteger('total_rows')->default(0);
            $table->unsignedInteger('processed_rows')->default(0);
            $table->unsignedInteger('successful_rows')->default(0);
            $table->unsignedInteger('failed_rows')->default(0);

            // Disk tempat file disimpan (mis. 'local', 's3', dll)
            $table->string('file_disk')->nullable();
             $table->string('file_name')->nullable();

            // Nama file hasil ekspor
            $table->string('file_path')->nullable();

            // Waktu ekspor selesai
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exports');
    }
};
