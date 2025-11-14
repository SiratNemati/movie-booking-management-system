<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('screens', function (Blueprint $table) {
            $table->json('show_times')->nullable(); // e.g., ["10:00", "14:00", "18:00", "21:00"]
            $table->decimal('price', 8, 2)->default(12.50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('screens', function (Blueprint $table) {
            $table->dropColumn(['show_times', 'price']);
        });
    }
};
