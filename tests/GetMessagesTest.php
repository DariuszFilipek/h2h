<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetMessagesTest
 */
class GetMessagesTest extends ApiTestCase
{
    /** test status code 200 **/
    public function test200response(): void
    {
        $response = static::createClient()->request('GET', 'api/messages');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /** test content **/
    public function testReturnContentCount(): void
    {
        $response = static::createClient()->request('GET', 'api/messages');

        $this->assertGreaterThanOrEqual(0, count($response->toArray()));
    }
}
