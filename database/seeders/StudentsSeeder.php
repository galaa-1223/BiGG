<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Students;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Students::create([
            'ner' => 'Болдбаатар',
            'ovog' => 'Цог',
            'urag' => 'Маарав',
            'tursun' => '2007-11-13',
            'register' => 'БЖ20009922',
            'huis' => 'er',
            'code' => '100001',
            'a_id' => '1',
            'password' => '12345678',
            'phone' => '88873342',
            'image' => null,
            'address' => null,
            'email' => 'student1@yahoo.com',
        ]);

        Students::create([
            'ner' => 'Гэрэлмаа',
            'ovog' => 'Болдбаатар',
            'urag' => 'Боржиган',
            'tursun' => '2008-01-01',
            'register' => 'ГН34345543',
            'huis' => 'em',
            'code' => '100002',
            'a_id' => '1',
            'password' => '12345678',
            'phone' => '98776677',
            'image' => null,
            'address' => null,
            'email' => 'student2@yahoo.com',
        ]);

        Students::create([
            'ner' => 'Сарангэрэл',
            'ovog' => 'Мятав',
            'urag' => 'Луут',
            'tursun' => '2007-11-13',
            'register' => 'РЧ44334455',
            'huis' => 'em',
            'code' => '100003',
            'a_id' => '1',
            'password' => '12345678',
            'phone' => '99993289',
            'image' => null,
            'address' => null,
            'email' => 'student3@yahoo.com',
        ]);
    }
}
