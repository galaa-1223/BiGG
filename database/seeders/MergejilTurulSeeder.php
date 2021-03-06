<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MergejilTurul;
use Carbon\Carbon;

class MergejilTurulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MergejilTurul::create([
            'ner' => 'Мэргэжлийн боловсрол олгох сургалт',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        MergejilTurul::create([
            'ner' => 'Техникийн боловсрол олгох сургалт',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        MergejilTurul::create([
            'ner' => 'Насанд хүрэгчдийн сургалт',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
