<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->bigIncrements('donors_id');

            $table->bigInteger('campaign_id')
                  ->foreign('campaign_id')
                  ->references('campaigns_id')->on('campaigns')
                  ->onDelete('cascade');
            $table->char('amount', 45);
            $table->char('currency', 45);
            $table->char('name', 45);
            $table->enum('show', ['1', '2']);
            $table->char('email', 190);
            $table->char('txid', 190);
            $table->enum('status', ['open', 'done', 'refused']);
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
        Schema::dropIfExists('donors');
    }
}
