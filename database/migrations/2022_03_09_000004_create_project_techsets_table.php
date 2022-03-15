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
        Schema::create('project_techsets', function (Blueprint $table) {
            $table->bigInteger('project_id',false,true); // sin autoincremento, unsigned
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade')
                ->onUpdate('cascade');            
            $table->string('techset_name',255);
            $table->unique(['project_id','techset_name']);
            $table->foreign('techset_name')
                ->references('name')
                ->on('techsets')
                ->onDelete('cascade')
                ->onUpdate('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_techsets');
    }
};
