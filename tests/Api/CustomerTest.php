<?php

namespace Tests\Api;

use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class CustomerTest
 * @package Tests\Api
 */
class CustomerTest extends TestCase
{
    use DatabaseMigrations;

    /** @var string $endpoint */
    protected $endpoint;

    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed');
        $this->endpoint = env('TEST_ENDPOINT', 'http://localhost:8000');
    }

    public function testBadCreatingCustomer()
    {
        $response = $this->postJson("{$this->endpoint}/api/customers", ['email' => 'testmail@mail.']);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $data = $response->json();
        $this->assertFalse($data['success']);
        $this->arrayHasKey('email', $data['errors']);
    }

    public function testSuccessCreatingCustomer()
    {
        $response = $this->postJson("{$this->endpoint}/api/customers", [
            'email' => 'testmail@mail.com',
            'first_name' => 'John',
            'last_name' => 'McClain',
            'gender' => 'male',
            'country' => 'US'
        ]);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment([
            'email' => 'testmail@mail.com',
            'first_name' => 'John',
            'last_name' => 'McClain',
            'gender' => 'male',
            'country' => 'US'
        ]);
    }

    public function testRemoveCustomer()
    {
        $response = $this->deleteJson("{$this->endpoint}/api/customers/1");
        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}