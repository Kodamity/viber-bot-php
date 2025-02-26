<?php

namespace Viber\Tests\Api;

use Viber\Api\Exception\ApiException;
use Viber\Tests\TestCase;
use Viber\Tests\ApiMock;
use Viber\Api\Signature;
use GuzzleHttp\Psr7\Response;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class ResponseTest extends TestCase
{
    public function testEmptyBody()
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionMessageMatches('/.*body.*/');

        $r = \Viber\Api\Response::create(
            new Response(200, [], ''),
        );
    }

    public function testWhenErrorStatus()
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionMessageMatches('/Remote error.*/');

        $responseData = json_encode([
            'status' => 1,
        ]);
        $r = \Viber\Api\Response::create(
            new Response(200, [], $responseData),
        );
    }

    public function testInvalidJson()
    {
        $this->expectException(ApiException::class);
        $this->expectExceptionMessageMatches('/.*json.*/');

        $responseData = json_encode([
            'no_status' => 'no_status',
        ]);
        $r = \Viber\Api\Response::create(
            new Response(200, [], $responseData),
        );
    }
}
