<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_admins', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 50);
            $table->string('password', 255);
            $table->string('cpf', 20)->nullable();
            $table->string('phone', 10)->nullable();
            $table->string('cep', 10)->nullable();
            $table->string('address', 80)->nullable();
            $table->string('number', 10)->nullable();
            $table->string('district', 80)->nullable();
            $table->string('city', 80)->nullable();
            $table->string('state', 2)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('user_admins');
    }
};
