<?php

namespace Tests\Unit;

use Tests\TestCase;


class APITest extends TestCase
{

    public function testAccess()
    {
        $response = $this->getJson('api/language');

        $response->assertStatus(201);
        $this->assertTrue(!empty($response['url']));
    }
}    