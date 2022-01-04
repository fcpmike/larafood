<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Error Validation Auth.
     *
     * @return void
     */
    public function testErrorValidationAuth()
    {
        $response = $this->postJson('/api/auth/token');

        $response->assertStatus(422);
    }

    /**
     * Error Auth Client Fake.
     *
     * @return void
     */
    public function testErrorAuthClientFake()
    {
        $payload = [
            'email' => 'email@email.com.br',
            'password' => '10101212',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(404)
                    ->assertExactJson([
                        'message' => trans('messages.invalid_credentials')
                    ]);
    }

    /**
     * Auth Client.
     *
     * @return void
     */
    public function testAuthClient()
    {
        $client = factory(Client::class)->create();

        $payload = [
            'email' => $client->email,
            'password' => 'password',
            'device_name' => Str::random(10),
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(200);
    }

    /**
     * Error Get Me.
     *
     * @return void
     */
    public function testErrorGetMe()
    {
        $response = $this->getJson('/api/auth/me');

        $response->assertStatus(401);
    }

    /**
     * Erro Get Me Token Fake.
     *
     * @return void
     */
    public function testErrorGetMeTokenFake()
    {
        $token = 'token_fake';

        $response = $this->getJson('/api/auth/me', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(401);
    }

    /**
     * Get Me.
     *
     * @return void
     */
    public function testGetMe()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->getJson('/api/auth/me', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200)
                    ->assertExactJson([
                        'data' => [
                            'name' => $client->name,
                            'email' => $client->email,
                        ]
                    ]);
    }

    /**
     * Logout.
     *
     * @return void
     */
    public function testLogout()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->postJson('/api/auth/logout', [], [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(204);
    }
}
