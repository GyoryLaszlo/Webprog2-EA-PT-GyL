<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Processzor;
use Database\Seeders\Traits\ReadsTsv;

class ProcesszorSeeder extends Seeder
{
    use ReadsTsv;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->readTsv('data/processzor.txt') as $r) {
            Processzor::updateOrCreate(
                ['id' => (int)$r['id']],
                ['gyarto'=>$r['gyarto'], 'tipus'=>$r['tipus']]
            );
        }
    }
}
