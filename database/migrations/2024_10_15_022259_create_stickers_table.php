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
        Schema::create('stickers', function (Blueprint $table) {
            $table->id();
            $table->string('property_no');
            $table->string('serial_no');
            $table->string('model_no');
            $table->text('description');
            $table->date('acquisition_date');
            $table->decimal('acquisition_cost', 10, 2);
            $table->string('accountable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stickers');
    }
};
