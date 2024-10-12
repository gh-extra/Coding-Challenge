<?php

namespace Database\Seeders;

use App\Models\Chain;
use App\Models\Prompt;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $test_user = User::factory()->create([
            'name'     => 'Test User',
            'email'    => 'test@prompthub.us',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name'     => 'Dalton Pierce',
            'email'    => 'dalton@prompthub.us',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name'     => 'Dan Cleary',
            'email'    => 'dan@prompthub.us',
            'password' => Hash::make('password'),
        ]);

        $chain = Chain::factory()->create([
            'user_id' => $test_user->id,
        ]);

        Prompt::factory(3)->create([
            'chain_id' => $chain->id,
        ]);
    }
}
