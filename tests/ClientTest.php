<?php

namespace Viber\Tests;

use Viber\Client;
use Viber\Tests\ApiMock;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class ClientTest extends TestCase
{
    public function testNoToken()
    {
        $this->expectException(\Viber\Api\Exception\ApiException::class);
        $this->expectExceptionMessageMatches('/No token.*/');

        new Client([]);
    }

    public function testInvalidHttpHook()
    {
        $this->expectException(\Viber\Api\Exception\ApiException::class);
        $this->expectExceptionMessageMatches('/^Invalid webhook .*/');

        (new Client([
            'token' => 'some-token'
        ]))
        ->setWebhook('http://some.url');
    }

    public function testServerError()
    {
        $this->expectException(\Viber\Api\Exception\ApiException::class);
        $this->expectExceptionMessageMatches('/Remote error.*/');

        $responseData = json_encode([
            'status' => 3,
            'status_message' => '...',
        ]);
        $handler = HandlerStack::create(
            new MockHandler([
                new Response(200, [], $responseData),
            ])
        );
        $client = new Client([
            'token' => 'token',
            'http' => [
                'handler' => $handler
            ]
        ]);
        $apinInfo = $client->call('get_account_info', []);
    }
}
