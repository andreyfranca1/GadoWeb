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
        Schema::create('vaccination_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flock_id')->constrained('flocks');
            $table->string('application_type');
            $table->string('batch', 100);
            $table->mediumText('description');
            $table->string('vet');
            $table->date('date');
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
        Schema::dropIfExists('vaccination_events');
    }
};
