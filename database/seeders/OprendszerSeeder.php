<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Oprendszer;
use Database\Seeders\Traits\ReadsTsv;

class OprendszerSeeder extends Seeder
{
     use ReadsTsv;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->readTsv('data/oprendszer.txt') as $r) {
            Oprendszer::updateOrCreate(
                ['id'=>(int)$r['id']],
                ['nev'=>$r['nev']]
            );
        }
    }
}
