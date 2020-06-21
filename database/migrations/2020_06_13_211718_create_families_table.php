<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('family_user', function (Blueprint $table){
            $table->foreignId('family_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_head')->default(false);
            $table->timestamp('joined_at');
            $table->softDeletes();
            $table->primary(['family_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_user');
        Schema::dropIfExists('families');
    }
}
