<?php declare(strict_types=1);

namespace WyriHaximus\React\Tests\Http\Middleware;

use React\EventLoop\Factory;
use React\Http\Io\HttpBodyStream;
use React\Http\Response;
use RingCentral\Psr7\ServerRequest;
use WyriHaximus\AsyncTestUtilities\AsyncTestCase;
use WyriHaximus\React\Http\Middleware\ResumeResponseBodyMiddleware;

/**
 * @internal
 */
final class ResumeResponseBodyMiddlewareTest extends AsyncTestCase
{
    public function testResume(): void
    {
        $loop = Factory::create();

        $body = $this->prophesize(HttpBodyStream::class);
        $body->resume()->shouldBeCalled();

        $response = (new Response())->withBody($body->reveal());

        $next = function () use ($response) {
            return $response;
        };

        $middleware = new ResumeResponseBodyMiddleware($loop);
        $middleware(new ServerRequest('GET', 'https://example.com/'), $next);

        $loop->run();
    }
}
