<?php

use App\Models\User;
use App\Models\Chain;

it('deletes a chain and its prompts', function () {
    $user = User::factory()->create();
    $chain = Chain::factory()->create(['user_id' => $user->id]);
    $prompt = $chain->prompts()->create(['input' => 'Sample input']);

    $response = $this
        ->actingAs($user)
        ->delete(route('chains.destroy', $chain));

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('chains.index'));

    $this->assertDatabaseMissing('chains', ['id' => $chain->id]);
    $this->assertDatabaseMissing('prompts', ['id' => $prompt->id]);
});

it('does not allow a user to delete another user\'s chain', function () {
    $user = User::factory()->create();
    $chain = Chain::factory()->create(['user_id' => $user->id]);

    $another_user = User::factory()->create();
    $response = $this
        ->actingAs($another_user)
        ->delete(route('chains.destroy', $chain));

    $response->assertStatus(403);

    $this->assertDatabaseHas('chains', ['id' => $chain->id]);
});
