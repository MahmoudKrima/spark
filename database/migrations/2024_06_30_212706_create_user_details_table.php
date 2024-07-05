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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate()
            ->unique();
            $table->integer('age')->unsigned();
            $table->tinyInteger('edu_level')->unsigned();
            $table->tinyInteger('married')->unsigned();
            $table->integer('kids')->unsigned();
            $table->tinyInteger('life_stage')->unsigned();
            $table->tinyInteger('occu_category')->unsigned();
            $table->integer('income')->unsigned();
            $table->tinyInteger('risk')->unsigned();
            $table->boolean('eager')->default(false);
            $table->integer('investment_amount')->unsigned();
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
