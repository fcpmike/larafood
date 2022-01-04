<?php

namespace Tests\Feature\Api;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class EvaluationTest extends TestCase
{
    /**
     * Test Error Create New Evaluation
     *
     * @return void
     */
    public function testErrorCreateNewEvaluation()
    {
        $order = 'fake_value';

        $response = $this->postJson("/auth/v1/orders/{$order}/evaluations");

        $response->assertStatus(401);
    }

    /**
     * Test Create New Evaluation
     *
     * @return void
     */
    public function testCreateNewEvaluation()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $order = $client->orders()->save(factory(Order::class)->make());

        $payload = [
            'stars' => 4,
            'comment' => Str::random(20),
        ];

        $headers = [
            'Authorization' => "Bearer {$token}",
        ];

        $response = $this->postJson(
            "/auth/v1/orders/{$order}/evaluations",
             $payload,
             $headers
        );

        $response->assertStatus(201);
    }
}
