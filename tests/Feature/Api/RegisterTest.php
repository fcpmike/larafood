<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Error create new Client.
     *
     * @return void
     */
    public function testErrorCreateNewClient()
    {
        $payload = [
            'name' => 'Fabiano Morais',
            'email' => 'fcpm_mike@hotmail.com',
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(422);
                    // ->assertExactJson([
                    //     'message' => 'The given data was invalid.',
                    //     'errors' => [
                    //         'passwords' => [trans('validation.required', ['attribute' => 'password'])]
                    //     ]
                    // ]);
    }

    /**
     * create new Client.
     *
     * @return void
     */
    public function testCreateNewClient()
    {
        $payload = [
            'name' => 'Fabiano Morais',
            'email' => 'fcpm_mike@hotmail.com',
            'password' => '123456',
        ];

        $response = $this->postJson('/api/auth/register', $payload);

        $response->assertStatus(201)
                    ->assertExactJson([
                        'data' => [
                            'name' => $payload['name'],
                            'email' => $payload['email'],
                        ]
                    ]);
    }
}
