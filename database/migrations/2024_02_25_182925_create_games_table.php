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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('est_length');
            $table->boolean('is_owned');
            $table->string('platform');
            $table->integer('cost')->nullable();
            $table->longText('why');

            $table->boolean("is_backlogged")->default(true);
            $table->boolean("is_currently_playing")->default(false);
            $table->boolean("is_dropped")->default(false);
            $table->boolean("is_shelved")->default(false);
            $table->boolean("is_beat")->default(false);

            $table->date("date_backlogged")->nullable();
            $table->date("date_started_playing")->nullable();
            $table->date("date_finished_playing")->nullable();
            
            $table->integer("hours_played")->nullable();

            $table->string("why_backlogged")->nullable();
            $table->string("why_dropped")->nullable();
            $table->string("why_shelved")->nullable();
            $table->string("review")->nullable();

            // RELATIONSHIPS
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
