<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('activity_type_id')->nullable();
            $table->unsignedBigInteger('military_organization_id')->nullable();
            $table->string('user_name');
            $table->string('title');
            $table->date('finished_date')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('comments')->nullable();
            $table->bigInteger('value_in_cents')->nullable();
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
        Schema::dropIfExists('activities');
    }
}
