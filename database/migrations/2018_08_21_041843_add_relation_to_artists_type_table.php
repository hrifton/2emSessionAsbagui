<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationToArtistsTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artistes_types', function (Blueprint $table) {
            $table->foreign('artiste_id')->references('id')->on('artistes');
            $table->foreign('type_id')->references('id')->on('types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('artistes_types', function (Blueprint $table) {
            $table->dropForeign('artists_artiste_id_foreign');
            $table->dropForeign('types_type_id_foreign');
        });
    }
}
