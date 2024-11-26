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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ITST_no')->unique();
            $table->date('date');
            $table->time('time');
            $table->string('client_name', 100);
            $table->string('office', 100);
            $table->string('equipment_type', 100);
            $table->string('serial_no', 100)->index();
            $table->string('problem', 255);
            $table->string('validated_problem', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
