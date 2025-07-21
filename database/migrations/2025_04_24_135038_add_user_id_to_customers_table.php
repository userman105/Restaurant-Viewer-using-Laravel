<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();  // Add the user_id column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Define the foreign key relationship
        });
    }

    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);  // Remove the foreign key
            $table->dropColumn('user_id');  // Remove the user_id column
        });
    }

}
