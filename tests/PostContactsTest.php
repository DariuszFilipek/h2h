<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PostContactsTest
 */
class PostContactsTest extends ApiTestCase
{
    /** test post request status code with empty json body **/
    public function testPostRequestWithEmptyBody(): void
    {
        $response = static::createClient()->request(
            'POST',
            'api/contacts',
            ['headers' =>
                [
                    'HTTP_ACCEPT' => 'application/json',
                    'HTTP_CONTENT_TYPE' => 'application/json'
                ]
            ]
        );

        $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
    }

    /** 201 request test*/
    public function testPost201Request(): void
    {
        $requestBody = [
            'firstName' => 'Dariusz',
            'lastName' => 'Filipek',
            'email' => 'dariusz.filipek@o2.pl',
            'message' => 'Wiadomość testowa',
            'personalDataProcessingAgree' => true,
        ];

        $response = static::createClient()->request(
            'POST',
            'api/contacts',
            [
                'headers' =>
                    [
                        'HTTP_ACCEPT' => 'application/json',
                        'HTTP_CONTENT_TYPE' => 'application/json'
                    ],
                'json' => $requestBody
            ]
        );

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }

    public function testPostProperDataPack(): void
    {
        $requestBody = [
            0 => [
                'firstName' => '',
                'lastName' => 'Filipek',
                'email' => 'dariusz.filipek@o2.pl',
                'message' => 'Wiadomość testowa',
                'personalDataProcessingAgree' => true,
            ],
            1 => [
                'firstName' => 'Dariusz',
                'lastName' => '',
                'email' => 'dariusz.filipek@o2.pl',
                'message' => 'Wiadomość testowa',
                'personalDataProcessingAgree' => true,
            ],
            2 => [
                'firstName' => 'Dariusz',
                'lastName' => 'Filipek',
                'email' => '',
                'message' => 'Wiadomość testowa',
                'personalDataProcessingAgree' => true,
            ],
            3 => [
                'firstName' => 'Dariusz',
                'lastName' => 'Filipek',
                'email' => 'dariusz.filipek@o2.pl',
                'message' => '',
                'personalDataProcessingAgree' => true,
            ],
            4 => [
                'firstName' => 'Dariusz',
                'lastName' => 'Filipek',
                'email' => 'dariusz.filipek@o2.pl',
                'message' => 'Wiadomość testowa',
                'personalDataProcessingAgree' => false,
            ]
        ];

        foreach ($requestBody as $key => $item) {
            $response = static::createClient()->request(
                'POST',
                'api/contacts',
                [
                    'headers' =>
                        [
                            'HTTP_ACCEPT' => 'application/json',
                            'HTTP_CONTENT_TYPE' => 'application/json'
                        ],
                    'json' => $item
                ]
            );

            $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
        }
    }

    public function testPostProperEmail(): void
    {
        $requestBody = [
            0 => [
                'firstName' => 'Dariusz',
                'lastName' => 'Filipek',
                'email' => 'dariusz.filipeko2.pl',
                'message' => 'Wiadomość testowa',
                'personalDataProcessingAgree' => true,
            ],
            1 => [
                'firstName' => 'Dariusz',
                'lastName' => 'Filipek',
                'email' => 'dariusz.filipek@',
                'message' => 'Wiadomość testowa',
                'personalDataProcessingAgree' => true,
            ],
            2 => [
                'firstName' => 'Dariusz',
                'lastName' => 'Filipek',
                'email' => 'dariusz.filipek@o2',
                'message' => 'Wiadomość testowa',
                'personalDataProcessingAgree' => true,
            ],
            3 => [
                'firstName' => 'Dariusz',
                'lastName' => 'Filipek',
                'email' => '@o2.pl',
                'message' => 'Wiadomość testowa',
                'personalDataProcessingAgree' => true,
            ],
            4 => [
                'firstName' => 'Dariusz',
                'lastName' => 'Filipek',
                'email' => 'o2.pl',
                'message' => 'Wiadomość testowa',
                'personalDataProcessingAgree' => true,
            ]
        ];

        foreach ($requestBody as $key => $item) {
            $response = static::createClient()->request(
                'POST',
                'api/contacts',
                [
                    'headers' =>
                        [
                            'HTTP_ACCEPT' => 'application/json',
                            'HTTP_CONTENT_TYPE' => 'application/json'
                        ],
                    'json' => $item
                ]
            );

            $this->assertEquals(Response::HTTP_UNPROCESSABLE_ENTITY, $response->getStatusCode());
        }
    }

    // Tutaj pozwolę się zatrzymać z rozpisaniem testów ale osobiście pokryłbym jeszcze uwzględnienie długości
    // imienia i nazwiska a także adresu e-mail i próbe wywołania innych nieprawidłowych zwrotek.
}
