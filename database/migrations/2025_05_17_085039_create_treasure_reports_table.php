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
        Schema::create('treasure_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treasure_id')->constrained()->onDelete('cascade');
            $table->string('report_reason');
            $table->string('additional_details')->default('');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treasure_reports');
    }
};
