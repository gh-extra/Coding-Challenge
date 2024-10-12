<?php

namespace Database\Factories;

use App\Models\Chain;
use App\Models\Prompt;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prompt>
 */
class PromptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chain_id' => Chain::factory(),
            'input' => $this->faker->sentences(5, true),
        ];
    }

    public function configure()
    {
        // Making sure that every new Prompt is appended to the Chain with a proper position
        // This is only a helper so that we can create multiple propmts for testing and they'll look ok in the UI
        // Product-wise, business rules such as this should be elsewhere
        return $this->afterCreating(function (Prompt $prompt) {
            if ($prompt->chain_id) {
                $max_position = Prompt::where('chain_id', $prompt->chain_id)->max('position');

                $prompt->position = $max_position + 1;
                $prompt->save();
            }
        });
    }
}
