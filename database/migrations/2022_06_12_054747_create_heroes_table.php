<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_local')->default(true);
            $table->integer('height');
            $table->integer('weight');
            $table->integer('intelligence');
            $table->integer('strength');
            $table->integer('speed');
            $table->integer('durability');
            $table->integer('power');
            $table->integer('combat');
            $table->foreignId('publisher_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('alignment_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('heroes');
    }
};
