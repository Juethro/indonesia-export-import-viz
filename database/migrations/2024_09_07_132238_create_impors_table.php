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
        Schema::create('import', function (Blueprint $table) {
            $table->id();
            $table->text('Type');
            $table->text('Month');
            $table->integer('Year');
            $table->float('Value');
            $table->float('Volume');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impors');
    }
};
