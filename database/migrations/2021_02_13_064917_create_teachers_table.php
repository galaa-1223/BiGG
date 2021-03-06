<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('ner', 30);
            $table->string('ovog', 30);
            $table->string('urag', 50);
            $table->date('tursun');
            $table->string('register', 10);
            $table->enum('huis', ['er', 'em'])->default('er');
            $table->char('code', 8);
            $table->string('password');
            $table->string('phone', 50)->nullable();
            $table->string('image', 200)->nullable();
            $table->string('address', 500)->nullable();
            $table->tinyInteger('mb_id');
            $table->tinyInteger('t_id');
            $table->enum('status', [1, 2, 3, 4])->default(1)->comment('1 - Ажиллаж байгаа,/n 2 - Халагдсан,/n 3 - Тэтгэвэрт/n 4 - Цагийн багш');
            $table->string('email', 50)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->json('config')->nullable();
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
        Schema::dropIfExists('teachers');
    }
}
