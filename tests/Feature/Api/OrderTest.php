<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * Validation New Order
     *
     * @return void
     */
    public function testValidationCreateNewOrder()
    {
        $payload = [];
        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(422)
                    ->assertJsonPath('errors.token_company', [
                        trans('validation.required', ['attribute' => 'token company'])
                    ])
                    ->assertJsonPath('errors.products', [
                        trans('validation.required', ['attribute' => 'products'])
                    ]);
    }

    /**
     * Create New Order
     *
     * @return void
     */
    public function testCreateNewOrder()
    {
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
        ];

        $products = factory(Product::class, 10)->create();
        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 2,
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201);
    }

    /**
     * Total Order
     *
     * @return void
     */
    public function testTotalOrder()
    {
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
        ];

        $products = factory(Product::class, 2)->create();
        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1,
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201)
                    ->assertJsonPath('data.total', 25.8);
    }

    /**
     * Test Order Not Found
     *
     * @return void
     */
    public function testOrderNotFound()
    {
        $order = 'fake_value';

        $response = $this->getJson("/api/v1/orders/{$order}");

        $response->assertStatus(404);
    }

    /**
     * Test Get Order
     *
     * @return void
     */
    public function testGetOrder()
    {
        $order = factory(Order::class)->create();

        $response = $this->getJson("/api/v1/orders/{$order->identify}");

        $response->assertStatus(200);
    }

    /**
     * Test Create New Order Authenticated
     *
     * @return void
     */
    public function testCreateNewOrderAuthenticated()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $tenant = factory(Tenant::class)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'products' => [],
        ];

        $products = factory(Product::class, 2)->create();
        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1,
            ]);
        }

        $response = $this->postJson('/api/auth/v1/orders', $payload, [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(201)
                    ->assertJsonPath('data.client.name', $client->name)
                    ->assertJsonPath('data.client.email', $client->email);
    }

    /**
     * Test Create New Order with Table
     *
     * @return void
     */
    public function testCreateNewOrderWithTable()
    {
        $table = factory(Table::class)->create();
        $tenant = factory(Tenant::class)->create();

        $payload = [
            'token_company' => $tenant->uuid,
            'table' => $table->uuid,
            'products' => [],
        ];

        $products = factory(Product::class, 2)->create();
        foreach ($products as $product) {
            array_push($payload['products'], [
                'identify' => $product->uuid,
                'qty' => 1,
            ]);
        }

        $response = $this->postJson('/api/v1/orders', $payload);

        $response->assertStatus(201)
                    ->assertJsonPath('data.table.identify', $table->uuid);
    }

    /**
     * Test Get My Orders
     *
     * @return void
     */
    public function testGetMyOrders()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        factory(Order::class, 10)->create(['client_id' => $client->id]);

        $response = $this->getJson('/api/auth/v1/my-orders', [
            'Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)
                    ->assertJsonCount(10, 'data');
    }
}