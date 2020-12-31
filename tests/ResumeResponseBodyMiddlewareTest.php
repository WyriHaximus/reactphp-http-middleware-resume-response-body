<?php

declare(strict_types=1);

namespace WyriHaximus\React\Tests\Http\Middleware;

use Prophecy\Argument;
use React\EventLoop\LoopInterface;
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
        $loop = $this->prophesize(LoopInterface::class);
        $loop->futureTick(Argument::that(static function (array $args): bool {
            $args[0]->{$args[1]}(); /** @phpstan-ignore-line */

            return true;
        }))->shouldBeCalled();

        $body = $this->prophesize(HttpBodyStream::class);
        $body->resume()->shouldBeCalled();

        $response = (new Response())->withBody($body->reveal());

        $next = static function () use ($response) {
            return $response;
        };

        $middleware = new ResumeResponseBodyMiddleware($loop->reveal());
        $middleware(new ServerRequest('GET', 'https://example.com/'), $next);
    }
}
