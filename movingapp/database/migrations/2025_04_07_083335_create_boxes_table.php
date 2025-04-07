<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxesTable extends Migration
{
    public function up()
    {
        Schema::create('boxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('max_weight', 8, 2)->nullable(); // kg-ban
            $table->decimal('width', 8, 2)->nullable(); // cm-ben
            $table->decimal('length', 8, 2)->nullable(); // cm-ben
            $table->decimal('height', 8, 2)->nullable(); // cm-ben
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('boxes');
    }
};
