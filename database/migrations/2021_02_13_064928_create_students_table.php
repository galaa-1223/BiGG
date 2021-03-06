<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
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
            $table->tinyInteger('a_id');
            $table->enum('status', [1, 2, 3])->default(1)->comment('1 - Суралцаж байгаа,/n 2 - Шилжсэн,/n 3 - Чөлөө авсан');
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
        Schema::dropIfExists('students');
    }
}
