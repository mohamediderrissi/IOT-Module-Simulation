<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('module_id')->unsigned();
            $table->index('module_id');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');

            $table->string('name');
            $table->string('number');
            $table->string('description');
            $table->string('type');
            $table->string('temperature')->nullable();
            $table->string('working_duration')->nullable();
            $table->string('number_data_sent')->nullable();  
            $table->string('working_state');

            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
}
