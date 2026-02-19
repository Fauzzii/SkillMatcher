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
        Schema::create('match_results', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->foreignId('job_id')->constrained()->cascadeOnDelete();
            $table->decimal('match_percentage', 5, 2)->nullable();
            $table->enum('recommendation_type', [
                'Priority Match',
                'Recommendation'
            ]);
            $table->timestamps();

            $table->unique(['user_id', 'job_id']);

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_results');
    }
};
