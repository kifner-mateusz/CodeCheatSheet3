<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class ProgrammingLanguageTest extends ApiTestCase
{
    public function testLanguage(): void
    {
        $response = static::createClient()->request('GET', '/api/language');

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([]);
    }

    public function testLanguageOne(): void
    {
        $client = static::createClient();
        $request = $client->request();
        $this->assertResponseIsSuccessful();

        // $response = static::createClient()->request('GET', '/api/language');
        // $this->assertResponseIsSuccessful();

        // $response = static::createClient()->request('DELETE', '/api/programming_languages/1');

        // $this->assertResponseIsSuccessful();
        $this->assertJsonContains([]);
    }
}
