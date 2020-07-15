<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontendUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frontend_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->notNullable()->unique();
            $table->string('username', 80)->notNullable()->unique();
            $table->string('email', 254)->notNullable()->unique();
            $table->string('password', 60)->notNullable();
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
        Schema::dropIfExists('frontend_users');
    }
}
