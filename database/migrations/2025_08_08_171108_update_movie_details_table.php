<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('movie_details', function (Blueprint $table) {
            $table->unsignedBigInteger('movie_id')->after('id');

            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');

            $table->renameColumn('origin_country', 'origin_country');
        });
    }

    public function down()
    {
        Schema::table('movie_details', function (Blueprint $table) {
            $table->dropForeign(['movie_id']);

            $table->dropColumn('movie_id');

            $table->renameColumn('origin_country', 'origin_country');
        });
    }
};
