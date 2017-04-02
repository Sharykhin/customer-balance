<?php

namespace Tests\Api;

use Illuminate\Http\Response;

/**
 * Class TransactionTest
 * @package Tests\Api
 */
class TransactionTest extends ApiTestCase
{
    public function testDeposit()
    {
        $response = $this->postJson("{$this->endpoint}/api/customers/2/deposit", ['amount' => 13.00]);

        $response->assertStatus(Response::HTTP_CREATED);
        $data = $response->json()['data'];
        $this->assertEquals(13.00, $data['amount']);
        $this->assertEquals('complete', $data['status']);
    }

    public function testWithdrawal()
    {
        $response = $this->postJson("{$this->endpoint}/api/customers/2/withdraw", ['amount' => 13.00]);
        $response->assertStatus(Response::HTTP_CREATED);
        $data = $response->json()['data'];
        $this->assertEquals(13.00, $data['amount']);
        $this->assertEquals('complete', $data['status']);
        $response = $this->postJson("{$this->endpoint}/api/customers/2/withdraw", ['amount' => 1300.00]);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJsonStructure([
            'errors' => [
                'amount'
            ]
        ]);
    }
}