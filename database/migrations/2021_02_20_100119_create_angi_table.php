<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angi', function (Blueprint $table) {
            $table->id();
            $table->string('ner', 300);
            $table->string('tovch', 10);
            $table->tinyInteger('course');
            $table->string('buleg', 1)->default('a');
            $table->mediumInteger('m_id');
            $table->mediumInteger('b_id');
            $table->timestamps();
            $table->engine = 'MyISAM';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angi');
    }
}
