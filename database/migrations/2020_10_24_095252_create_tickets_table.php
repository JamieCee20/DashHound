<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticket_id')->unique(); // Ticket ID
            $table->unsignedBigInteger('user_id'); // User ID of user creating the ticket
            $table->unsignedBigInteger('manager_id')->nullable(); // Alocated Supervisor to deal with ticket
            $table->string('title');
            $table->unsignedBigInteger('ticket_category');
            $table->unsignedBigInteger('ticket_status');
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
        Schema::dropIfExists('tickets');
    }
}
