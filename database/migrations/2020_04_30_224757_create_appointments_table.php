<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->efficientUuid('uuid')->index();
            $table->string('reference')->unique();
            $table->morphs('appointmentable');
            $table->foreignId('event_date_id')->constrained();
            $table->foreignId('region_id')->constrained();
            $table->foreignId('status_id')->constrained();
            $table->string('type')->default('Consulting');
            $table->boolean('with_family')->default(false);
            $table->timestamps();
        });


        Schema::create('appointment_item', function (Blueprint $table) {
            $table->foreignId('appointment_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->unsignedInteger('quantity');
            $table->decimal('price',13,2);

            $table->primary(['appointment_id','item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment_item');
        Schema::dropIfExists('appointments');
    }
}
