<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostingsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postings_translations', function (Blueprint $table) {
            $table->id();
            $table->string('language');
            $table->string('title');
            $table->text('description');
            $table->text('salary');
            $table->timestamps();
            $table->foreignId('posting_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postings_translations');
    }
}
