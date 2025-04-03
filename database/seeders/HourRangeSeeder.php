<?php

namespace Database\Seeders;

use App\Models\HourRange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HourRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $ranges = ["08:00-10:00", "10:00-12:00", "12:00-14:00", "16:00-18:00", "18:00-20:00"];
        foreach($ranges as $range){
            HourRange::create([
                'value' => explode('-', $range)[0] . ' - ' . explode('-', $range)[1],
                'start' => explode('-', $range)[0],
                'end' => explode('-', $range)[1]
            ]);
        }
    }
}
