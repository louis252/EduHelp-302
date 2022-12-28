<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReqListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('req_lists', function (Blueprint $table) {
            $table->increments('requestID');
            $table->date('requestDate');
            $table->boolean('requestStatus');
            $table->string('description');
            $table->string('requestType');
            $table->date('proposedDate')->nullable()->default(NULL);
            $table->time('proposedTime')->nullable()->default(NULL);
            $table->integer('studentLevel')->nullable()->default(NULL);
            $table->integer('numStudent')->nullable()->default(NULL);
            $table->string('resourceType')->nullable()->default(NULL);
            $table->integer('numRequired')->nullable()->default(NULL);
            $table->integer('schoolID')->nullable()->default(NULL);
            $table->integer('offerID')->nullable()->default(NULL);
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
        Schema::dropIfExists('req_lists');
    }
}
