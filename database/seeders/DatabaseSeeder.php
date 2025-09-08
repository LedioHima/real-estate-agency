<?php

namespace Database\Seeders;

use App\Models\Agent;
use App\Models\Property;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{

    // Create 5 agents
    $agents = Agent::factory(5)->create();

    \App\Models\Property::factory(18)->create();

    // Assign properties to random agents
    Property::all()->each(function ($property) use ($agents) {
        $property->agent_id = $agents->random()->id;
        $property->save();
    });
}
}
