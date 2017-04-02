<?php

namespace Tests\Api;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * Class ApiTestCase
 * @package Tests\Api
 */
class ApiTestCase extends TestCase
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

    public function tearDown()
    {
        parent::tearDown();
    }
}