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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('type', 10);
            $table->string('name', 255);
            $table->string('doc_number', 20);
            $table->string('doc_number2', 20);
            $table->string('email', 100)->nullable();
            $table->string('phone', 10)->nullable();
            $table->string('cellphone', 10);
            $table->string('cep', 10);
            $table->string('address', 80);
            $table->string('number', 10);
            $table->string('district', 80);
            $table->string('city', 80);
            $table->string('state', 2);
            $table->date('born_date');
            $table->integer('status');
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
        Schema::dropIfExists('companies');
    }
};
