<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('logger_email')->nullable();
            $table->string('station')->nullable();
            $table->string('region')->nullable();
            $table->string('unit')->nullable();

            $table->string('programme')->nullable();
            $table->string('service')->nullable();
            $table->string('problem_type')->nullable();
            

            $table->string('event_date')->nullable();
            $table->string('event_time')->nullable();
            $table->string('downtime')->nullable();
            $table->string('event_nature')->nullable();

            $table->string('priority')->nullable();

            $table->string('description')->nullable();
           
            $table->string('status')->nullable();
            $table->string('action_comment')->nullable();
            $table->timestamp('action_time')->nullable();

            $table->string('escalated_to')->nullable();
            $table->timestamp('escalation_time')->nullable();

            
            $table->string('escalation_comment')->nullable();

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
        Schema::dropIfExists('logs');
    }
}
