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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id',false,true); // sin autoincremento, unsigned
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');            
            $table->string('filename',255);
            $table->string('filetype',255);
            $table->string('route',255);
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
        Schema::dropIfExists('files');
    }
};
