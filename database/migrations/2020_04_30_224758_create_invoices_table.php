<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->efficientUuid('uuid')->index();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('status_id')->constrained();
            $table->decimal('amount', 13, 2);
            $table->decimal('discount', 13, 2);
            $table->mediumText('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('invoice_item', function (Blueprint $table) {
            $table->foreignId('invoice_id')->constrained();
            $table->foreignId('item_id')->constrained();
            $table->integer('quantity')->unsigned();
            $table->decimal('price',13,2);

            $table->primary(['invoice_id','item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_item');
        Schema::dropIfExists('invoices');
    }
}
