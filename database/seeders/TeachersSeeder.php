<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teachers;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teachers::create([
            'ner' => 'Баярсайхан',
            'ovog' => 'Батмандах',
            'urag' => 'Монгол',
            'tursun' => '1985-03-29',
            'register' => 'ХЫ85032921',
            'huis' => 'er',
            'code' => '12345678',
            'password' => '12345678',
            'phone' => '88118811',
            'image' => null,
            'address' => null,
            'mb_id' => 1,
            't_id' => 2,
            'status' => 1,
            'email' => 'teacher1@yahoo.com',
        ]);

        Teachers::create([
            'ner' => 'Идэр',
            'ovog' => 'Доржсүрэн',
            'urag' => 'Хүнд',
            'tursun' => '1983-02-15',
            'register' => 'РБ83021534',
            'huis' => 'er',
            'code' => '12345679',
            'password' => '12345678',
            'phone' => '87323388',
            'image' => null,
            'address' => null,
            'mb_id' => 2,
            't_id' => 2,
            'status' => 1,
            'email' => 'teacher2@yahoo.com',
        ]);

        Teachers::create([
            'ner' => 'Бовкамаа',
            'ovog' => 'Батболд',
            'urag' => 'Илжгэн',
            'tursun' => '1982-03-29',
            'register' => 'ХЫ85032921',
            'huis' => 'em',
            'code' => '12345677',
            'password' => '12345678',
            'phone' => '99118811',
            'image' => null,
            'address' => null,
            'mb_id' => 3,
            't_id' => 1,
            'status' => 1,
            'email' => 'teacher3@yahoo.com',
        ]);

        Teachers::create([
            'ner' => 'Жавзмаа',
            'ovog' => 'Шийрэв',
            'urag' => 'Илжгэн',
            'tursun' => '1955-03-29',
            'register' => 'ХЫ85032921',
            'huis' => 'em',
            'code' => '12345670',
            'password' => '12345678',
            'phone' => '99118811',
            'image' => null,
            'address' => null,
            'mb_id' => 3,
            't_id' => 1,
            'status' => 3,
            'email' => 'teacher3@yahoo.com',
        ]);

        Teachers::create([
            'ner' => 'Мөнхсайхан',
            'ovog' => 'Дэлгэр',
            'urag' => 'Илжгэн',
            'tursun' => '1990-02-19',
            'register' => 'ХЫ85032921',
            'huis' => 'em',
            'code' => '12345699',
            'password' => '12345678',
            'phone' => '99118811',
            'image' => null,
            'address' => null,
            'mb_id' => 3,
            't_id' => 1,
            'status' => 4,
            'email' => 'teacher3@yahoo.com',
        ]);
    }
}
