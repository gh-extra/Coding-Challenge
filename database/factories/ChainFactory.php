<?php

namespace Database\Factories;

use App\Models\User;
use App\Services\ChatEngines\ChatEngine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chain>
 */
class ChainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'chat_engine_id' => $this->faker->randomElement(ChatEngine::CHAT_ENGINES),
            'user_id' => User::factory(),
        ];
    }
}
