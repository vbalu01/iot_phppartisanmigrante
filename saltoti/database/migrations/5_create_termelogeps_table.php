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
        Schema::create('termelogeps', function (Blueprint $table) {
            $table->id("ID");
            $table->string("name",55);
            $table->bigInteger('UzemID')->unsigned()->index();
            $table->foreign('UzemID')->references('ID')->on('uzems')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('darabszenzor')->unsigned()->index();
            $table->foreign('darabszenzor')->references('ID')->on('sensors')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('kwhSzenzor')->unsigned()->index();
            $table->foreign('kwhSzenzor')->references('ID')->on('sensors')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('ElszivoID')->unsigned()->index();
            $table->foreign('ElszivoID')->references('ID')->on('elszivos')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('termelogeps');
    }
};
