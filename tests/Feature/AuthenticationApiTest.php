<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('user can login and receive a token', function () {

    $email = 'john@example.com';
    $password = 'password';

    User::factory()->create([
        'email' => $email,
        'password' => Hash::make($password),
    ]);

    $response = $this->postJson('/api/auth/token', [
        'email' => $email,
        'password' => $password,
    ]);

    $response
        ->assertStatus(200)
        ->assertJsonStructure(['token']);
});

test('user cannot login with incorrect credentials', function () {
    $email = 'john@example.com';
    $password = 'password';
    $incorrectPassword = 'wrong-password';

    User::factory()->create([
        'email' => $email,
        'password' => Hash::make($password),
    ]);

    $response = $this->postJson('/api/auth/token', [
        'email' => $email,
        'password' => $incorrectPassword,
    ]);

    $response
        ->assertStatus(422) // Validation Exception
        ->assertJsonValidationErrors('email');
});

test('authenticated user can logout', function () {
    $user = User::factory()->create();
    $token = $user->createToken('my-app-token')->plainTextToken;

    $response = $this->postJson('/api/auth/logout', [], [
        'Authorization' => 'Bearer ' . $token,
    ]);

    $response->assertNoContent();
});

test('authenticated user can logout from all devices', function () {
    $user = User::factory()->create();
    $token = $user->createToken('my-app-token')->plainTextToken;

    $response = $this->postJson('/api/auth/logout-everywhere', [], [
        'Authorization' => 'Bearer ' . $token,
    ]);

    $response->assertNoContent();
});

test('unauthenticated user cannot logout', function () {
    $response = $this->postJson('/api/auth/logout');

    $response->assertStatus(401);
});
