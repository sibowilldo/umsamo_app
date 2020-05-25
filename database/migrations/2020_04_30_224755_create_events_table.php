<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->efficientUuid('uuid')->index();
            $table->foreignId('status_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->string('title', 50);
            $table->mediumText('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('event_region', function (Blueprint $blueprint){
            $blueprint->foreignId('event_id')->constrained();
            $blueprint->foreignId('region_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_region');
        Schema::dropIfExists('events');
    }
}
