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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->uuid('owner_id');
            $table->string('company_name', 150);
            $table->text('description')->nullable();
            $table->string('email', 150)->nullable();
            $table->string('location', 150)->nullable();
            $table->string('website', 150)->nullable();
            $table->timestamps();

            $table->foreign('owner_id')
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
        Schema::dropIfExists('companies');
    }
};
