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
        Schema::create('elszivos', function (Blueprint $table) {
            $table->id("ID");
            $table->string("name",55);
            $table->bigInteger('kwhSzenzor')->unsigned()->index();
            $table->foreign('kwhSzenzor')->references('ID')->on('sensors')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elszivos');
    }
};
