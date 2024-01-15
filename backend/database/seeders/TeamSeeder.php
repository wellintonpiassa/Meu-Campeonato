<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $teams = [
            ['name' => 'Palmeiras'],
            ['name' => 'Santos'],
            ['name' => 'Flamengo'],
            ['name' => 'Corinthians'],
            ['name' => 'Bahia'],
            ['name' => 'Vasco'],
            ['name' => 'Fluminense'],
            ['name' => 'Botafogo'],
            ['name' => 'Grêmio'],
            ['name' => 'Fortaleza'],
            ['name' => 'Avaí'],
            ['name' => 'Coritiba'],
        ];
        
        foreach($teams as $team){
            Team::create($team);
        }
    }
}
