<?php

declare(strict_types=1);

namespace WyriHaximus\React\Tests\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use React\EventLoop\Loop;
use React\Http\Io\HttpBodyStream;
use React\Http\Message\Response;
use RingCentral\Psr7\ServerRequest;
use WyriHaximus\AsyncTestUtilities\AsyncTestCase;
use WyriHaximus\React\Http\Middleware\ResumeResponseBodyMiddleware;

/**
 * @internal
 */
final class ResumeResponseBodyMiddlewareTest extends AsyncTestCase
{
    /**
     * @test
     */
    public function resume(): void
    {
        $body = $this->prophesize(HttpBodyStream::class);
        $body->resume()->shouldBeCalled();

        $response = (new Response())->withBody($body->reveal());

        $next = static fn (): ResponseInterface => $response;

        $middleware = new ResumeResponseBodyMiddleware();
        $middleware(new ServerRequest('GET', 'https://example.com/'), $next);

        Loop::run();
    }
}
