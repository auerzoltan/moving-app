<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectsTable extends Migration
{
    public function up()
    {
        Schema::create('objects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('box_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('weight', 8, 2)->nullable(); // kg-ban
            $table->decimal('width', 8, 2)->nullable(); // cm-ben
            $table->decimal('length', 8, 2)->nullable(); // cm-ben
            $table->decimal('height', 8, 2)->nullable(); // cm-ben
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('objects');
    }
};
