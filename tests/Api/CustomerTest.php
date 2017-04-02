<?php

namespace Tests\Api;

use Illuminate\Http\Response;

/**
 * Class CustomerTest
 * @package Tests\Api
 */
class CustomerTest extends ApiTestCase
{

    public function testGettingCustomerList()
    {
        $response = $this->getJson("{$this->endpoint}/api/customers?limit=1&offset=1");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'success',
            'data' => [
                [
                    'id',
                    'email',
                    'first_name',
                    'last_name',
                    'balance',
                    'bonus',
                    'bonus_percent',
                    'created_at',
                    'country',
                    'gender'
                ]
            ],
            'errors',
            'meta' => [
                'total',
                'count',
                'limit',
                'offset'
            ]]);

        $response->assertJsonFragment([
            'success' => true,
            'errors' => null
        ]);
        $meta = $response->json()['meta'];
        $this->assertEquals(1, $meta['limit']);
        $this->assertEquals(1, $meta['offset']);
        $this->assertEquals(1, $meta['count']);
    }

    public function testBadCreatingCustomer()
    {
        $response = $this->postJson("{$this->endpoint}/api/customers", ['email' => 'testmail@mail.']);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);

        $response->assertJsonStructure([
            'success',
            'data',
            'errors' => [
                'email',
                'first_name',
                'last_name',
                'gender',
                'country'
            ]
        ]);

        $response->assertJsonFragment([
            'success' => false,
            'data' => null
        ]);
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

    public function testGetOneCustomer()
    {
        $response = $this->getJson("{$this->endpoint}/api/customers/2");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'email',
                'first_name',
                'last_name',
                'balance',
                'bonus',
                'bonus_percent'
            ]]);
    }

    public function updateCustomer()
    {
        $response = $this->patchJson("{$this->endpoint}/api/customers/2", ['first_name' => 'Changed']);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'first_name'
            ]]);

        $response->assertJsonFragment(['data' => ['first_name' => 'Changed']]);
    }
}