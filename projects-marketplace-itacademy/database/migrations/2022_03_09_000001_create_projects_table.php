<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id',false,true); // sin autoincremento, unsigned
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('title',255);
            $table->timestamp('publishedDate')->nullable(); // Si no pongo nullable, default value es urrent_timestamp()
            $table->timestamp('deadline')->nullable(); // Si no pongo nullable y publishedDate no es nullable, la migración da error ¿Alguien lo entiende?
            $table->string('shortExplanation',255);
            $table->enum('state',['accepted','published','refused','doing','finished']);
            $table->decimal('bid',9,2,true); // unsigned con 9 digitos, 2 de ellos decimales
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
        Schema::dropIfExists('projects');
    }
};
