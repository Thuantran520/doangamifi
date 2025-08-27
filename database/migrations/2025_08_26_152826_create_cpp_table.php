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
        Schema::create('cpp', function (Blueprint $table) {
            $table->bigIncrements('lesson_id');
            $table->string('title');
            $table->text('content')->nullable();
            $table->text('example')->nullable();
            $table->string('topic')->nullable();
            $table->integer('order')->nullable();
            $table->date('created_at')->nullable();
            $table->date('updated_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpp');
    }
};
