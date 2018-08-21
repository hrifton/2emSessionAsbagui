<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->nullable();
            $table->string('titre')->nullable();
            $table->text('descriptif')->nullable();
            $table->integer('categorie_id')->unsigned();
            $table->string('poster_url')->nullable();
            $table->integer('location_id')->unsigned();
            $table->string('prix')->nullable();
            $table->text('artistes')->nullable();
            $table->smallInteger('bookable')->nullable();
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
        Schema::dropIfExists('shows');
    }
}
