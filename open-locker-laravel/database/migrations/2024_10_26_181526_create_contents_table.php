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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')->nullable()->default(null)->constrained('users');
            $table->timestamp('taken_at')->nullable()->default(null);
            $table->timestamps();
            $table->foreignId('image_id')->nullable()->constrained('images')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
