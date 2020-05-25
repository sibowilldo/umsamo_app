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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_date_id')->constrained();
            $table->foreignId('region_id')->constrained();
            $table->foreignId('status_id')->constrained();
            $table->timestamp('reserved_at');
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
        Schema::dropIfExists('appointments');
    }
}
