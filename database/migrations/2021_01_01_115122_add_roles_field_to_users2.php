<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRolesFieldToUsers2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users2', function (Blueprint $table) {
            $table->string('roles')->default('USER');//USER(BUYER,SELLLER),Admin(ALL ACCCESS)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users2', function (Blueprint $table) {
            $table->dropColumn('roles');
        });
    }
}
