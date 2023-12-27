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
        Schema::create('components', function (Blueprint $table) {
            $table->string('component_id')->primary();
            $table->string('name');
            $table->string('model');
            $table->string('manufacturer');
            $table->integer('quantity')->default(1);
            $table->string('description')->nullable();

            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('user_id');
            $table->string('type_id');
            $table->string('computer_id')->nullable();
            $table->unsignedBigInteger('specification_id');

            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('type_id')->references('type_id')->on('types');
            $table->foreign('computer_id')->references('computer_id')->on('computers');
            $table->foreign('specification_id')->references('specification_id')->on('specifications');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
