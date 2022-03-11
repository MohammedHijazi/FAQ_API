<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users','id');
            $table->string('title',255)->nullable();
            $table->longText('details')->nullable();
            $table->string('image_path',255)->nullable();
            $table->string('youtube_link',255)->nullable();
            $table->integer('font_size')->nullable();
            $table->string('algiment',255)->nullable();
            $table->string('color',255)->nullable();
            $table->string('url',255)->nullable();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('questions');

    }
}
