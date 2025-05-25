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
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->text('problem');
            $table->text('note')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->foreignId('created_by')
                ->constrained('users')
                ->onDelete('cascade');;
            $table->foreignId('answered_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('problems');
    }
};
