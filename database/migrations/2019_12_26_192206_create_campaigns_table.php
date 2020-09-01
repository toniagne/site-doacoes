<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('campaigns_id');
            $table->string('title');
            $table->text('introduction');
            $table->text('description')->nullable();
            $table->text('image');
            $table->text('image_slide');
            $table->char('victims', 45);
            $table->char('amounts', 45);
            $table->char('vlr', 45);
            $table->char('color', 45);
            $table->char('slug', 45);
            $table->enum('status', ['inactive', 'active']);
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
        Schema::dropIfExists('campaigns');
    }
}
