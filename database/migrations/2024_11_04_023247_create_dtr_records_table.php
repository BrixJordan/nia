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
        Schema::create('dtr_records', function (Blueprint $table) {
            $table->id();
            $table->string('acc_no');  // acc_no matches employee acc_no type
            $table->dateTime('date_time');
            $table->timestamps();

            // Foreign key to employees table
            $table->foreign('acc_no')->references('acc_no')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dtr_records', function (Blueprint $table) {
            $table->dropForeign(['acc_no']);
        });

        Schema::dropIfExists('dtr_records');
    }
};
