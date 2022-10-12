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
        Schema::create('table_vaccination_event_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('vaccination_events');
            $table->foreignId('vaccine_id')->constrained('vaccines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_vaccination_event_items');
    }
};
