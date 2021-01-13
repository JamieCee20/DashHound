<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TicketForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ticket_category')->references('id')->on('ticket_categories')->onDelete('cascade');
            $table->foreign('ticket_status')->references('id')->on('ticket_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function(Blueprint $table) {
            $table->dropForeign('tickets_user_id_foreign');
            $table->dropForeign('tickets_manager_id_foreign');
            $table->dropForeign('tickets_ticket_category_foreign');
            $table->dropForeign('tickets_ticket_status_foreign');
        });
    }
}
