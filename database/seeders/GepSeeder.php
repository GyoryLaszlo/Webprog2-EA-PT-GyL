<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gep;
use Database\Seeders\Traits\ReadsTsv;

class GepSeeder extends Seeder
{
    use ReadsTsv;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->readTsv('data/gep.txt') as $r) {
            Gep::create([
                'gyarto'       => $r['gyarto'],
                'tipus'        => $r['tipus'],
                'kijelzo'      => $r['kijelzo'],
                'memoria'      => (int)$r['memoria'],
                'merevlemez'   => (int)$r['merevlemez'],
                'videovezerlo' => $r['videovezerlo'],
                'ar'           => (int)$r['ar'],
                'processzorid' => (int)$r['processzorid'],
                'oprendszerid' => (int)$r['oprendszerid'],
                'db'           => (int)$r['db'],
            ]);
        }
    }
}
