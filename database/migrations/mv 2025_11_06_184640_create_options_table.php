<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('poll_id'); // must match polls.id type
            $table->string('option_text');
            $table->timestamps();
            $table->engine = 'InnoDB';

            // foreign key constraint
            $table->foreign('poll_id')
                  ->references('id')
                  ->on('polls')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
