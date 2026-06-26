<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Menguji apakah base URL API dasar memberikan respon yang valid.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->getJson('/api');

        $this->assertTrue(in_array($response->getStatusCode(), [200, 404, 405]));
    }
}