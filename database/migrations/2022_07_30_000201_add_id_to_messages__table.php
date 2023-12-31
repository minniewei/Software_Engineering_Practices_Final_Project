<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdToMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages_', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->bigInteger('userid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages_', function (Blueprint $table) {
            $table->dropColumn('userid');
            $table->string('name', 255);
        });
    }
}
