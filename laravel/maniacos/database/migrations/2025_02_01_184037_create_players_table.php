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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Player name.');
            $table->integer('height')->nullable()->comment('Player height.');
            $table->integer('weight')->nullable()->comment('Player weight.');
            $table->date('birthdate')->comment('Player birthdate.');
            $table->enum('category', [1, 2, 3, 4, 5, 6, 7, 8, 9])->comment('Player category (1=Sub-13, 2=Sub-15, ..., 5=Adulto)');
            $table->string('email')->unique()->comment('Player e-mail.');
            $table->boolean('isSuspended')->default(false)->comment('Indicates if player was suspended');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
