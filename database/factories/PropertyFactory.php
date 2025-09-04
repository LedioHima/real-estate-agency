<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->streetName().' '.fake()->randomElement(['Apartment','Home','Villa','Penthouse']);
        return [
            'title' => $title,
            'slug'  => Str::slug($title).'-'.fake()->unique()->numerify('#####'),
            'city'  => fake()->randomElement(['Tirana','Durrës','Vlorë','Shkodër']),
            'type'  => fake()->randomElement(['Apartment','House','Penthouse','Villa']),
            'price' => fake()->numberBetween(80000, 450000),
            'image' => null,
            'description' => fake()->paragraph(),
            'agent_id' => null, // hook up later
        ];
    }
}
