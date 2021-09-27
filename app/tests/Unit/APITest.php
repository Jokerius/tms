<?php

namespace Tests\Unit;

use Tests\TestCase;
use RefreshDatabase;

class APITest extends TestCase
{

    public function testAccessWithoutToken()
    {
        $response = $this->getJson('api/language');

        $response->assertStatus(403);
    }
    
    public function testAccessWithToken()
    {
        $this->withHeaders([
            'auth-token' => 'QZWm7dgIj0061uUZ',
        ]);        
        
        $response = $this->getJson('api/language');

        $response->assertStatus(200);
    }    
}    