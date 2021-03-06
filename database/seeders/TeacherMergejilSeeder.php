<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeacherMergejil;

class TeacherMergejilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TeacherMergejil::create([
            'ner' => 'Компьютерийн багш'
        ]);

        TeacherMergejil::create([
            'ner' => 'Физикийн багш'
        ]);

        TeacherMergejil::create([
            'ner' => 'Химийн багш'
        ]);

        TeacherMergejil::create([
            'ner' => 'Биеийн тамирын багш'
        ]);
    }
}
