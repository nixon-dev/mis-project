<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document', function (Blueprint $table) {
            $table->id('document_id');
            $table->string('document_title');
            $table->integer('document_origin');
            $table->string('document_nature');
            $table->integer('document_number');
            $table->date('document_deadline');
            $table->timestamps();
        });

        Schema::create('history', function (Blueprint $table) {
            $table->id('history_id');
            $table->integer('document_id');
            $table->string('history_name');
            $table->date('history_date');
            $table->string('history_action');
            $table->timestamps();
        });

        Schema::create('office', function (Blueprint $table) {
            $table->id('office_id');
            $table->string('office_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document');
        Schema::dropIfExists('history');
        Schema::dropIfExists('office');
    }
};