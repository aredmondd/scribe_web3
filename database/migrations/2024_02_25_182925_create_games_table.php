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

            $table->date('date_started')->nullable();
            $table->date('date_dropped')->nullable();
            $table->date('date_retired')->nullable();
            $table->date('date_finished')->nullable();

            $table->integer('hours_played')->nullable();
            $table->longText('reason_dropped')->nullable();
            $table->longText('reason_retired')->nullable();
            $table->boolean('want_to_revisit')->nullable();
            $table->boolean('did_100%')->nullable();
            $table->longText('review')->nullable();
            $table->integer('star_score')->nullable();
            $table->timestamps();

            // RELATIONSHIPS
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
