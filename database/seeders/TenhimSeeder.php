<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenhim;

class TenhimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenhim::create([
            'ner' => 'Ерөнхий эрдмийн тэнхим',
            'tovch' => 'ЕЭТ'
        ]);

        Tenhim::create([
            'ner' => 'Техник технологийн тэнхим',
            'tovch' => 'TTT'
        ]);
    }
}
