<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname', 60)->nullable();
            $table->string('lastname', 60)->nullable();
            $table->string('company_name', 60)->nullable();
            $table->integer('tel')->nullable();
            $table->string('website', 60)->nullable();
            $table->string('description')->nullable();
            $table->string('profile_pic', 100)->nullable();
            $table->string('logo', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
