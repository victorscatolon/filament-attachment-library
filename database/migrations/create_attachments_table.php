<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();

            // Polymorphic relationship
            $table->unsignedBigInteger('attachable_id');
            $table->string('attachable_type')->index();
            $table->index(['attachable_type', 'attachable_id']);

            $table->string('filename')->index();
            $table->string('mime_type')->nullable();
            $table->string('disk')->nullable();
            $table->string('path')->index();
            $table->unsignedBigInteger('size')->nullable();
            $table->string('hash', 64)->nullable(); // SHA-256
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
