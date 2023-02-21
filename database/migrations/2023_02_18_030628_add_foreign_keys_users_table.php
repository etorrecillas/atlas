<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('ranking_id')->references('id')->on('rankings')->onDelete('set null');
            $table->foreign('military_branch_id')->references('id')->on('military_branches')->onDelete('set null');
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('set null');
            $table->foreign('military_organization_id')->references('id')->on('military_organizations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['ranking_id']);
            $table->dropForeign(['military_branch_id']);
            $table->dropForeign(['specialty_id']);
            $table->dropForeign(['military_organization_id']);
        });
    }
}
