<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Language;

class APITest extends TestCase
{
    use RefreshDatabase;
    
    private $readToken = 'm3GhR0Z6HgjNr5lE';
    private $writeToken = 'QZWm7dgIj0061uUZ';

    public function testAccessWithoutToken()
    {
        $response = $this->getJson('api/language');

        $response->assertStatus(403);
    }
    
    public function testAccessWithToken()
    {
        $this->withHeaders([
            'auth-token' => $this->readToken,
        ]);        
        
        $response = $this->getJson('api/language');

        $response->assertStatus(200);
        $languages = Language::orderBy('name')->pluck('name')->all();
        $this->assertEquals($languages, $response->getData());
    }    
    
    public function testExport()
    {
        $this->withHeaders([
            'auth-token' => $this->readToken,
        ]);        
        
        $response = $this->getJson('api/export?type=yaml');
        $response->assertStatus(200);        
        $this->assertEquals($response->getFile()->getPathname(), '/var/www/html/app/storage/translations.yaml');
    }       
}    