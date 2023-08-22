<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtworksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artworks', function (Blueprint $table) {
            $table->id('objectId');
            $table->string('title');
            $table->string('artistDisplayName');
            $table->string('primaryImage');
            $table->string('department');
            $table->text('artistDisplayBio');
            $table->string('artistNationality');
            $table->integer('artistBeginDate');
            $table->integer('artistEndDate');
            $table->string('artistWikidata_URL');
            $table->integer('objectBeginDate');
            $table->integer('objectEndDate');
            $table->string('dimensions');
            $table->string('objectURL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artworks');
    }
}
