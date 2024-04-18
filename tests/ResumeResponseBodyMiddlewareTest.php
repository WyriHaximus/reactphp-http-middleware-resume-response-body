<?php

declare(strict_types=1);

namespace WyriHaximus\React\Tests\Http\Middleware;

use Mockery;
use Psr\Http\Message\ResponseInterface;
use React\Http\Io\HttpBodyStream;
use React\Http\Message\Response;
use RingCentral\Psr7\ServerRequest;
use WyriHaximus\AsyncTestUtilities\AsyncTestCase;
use WyriHaximus\React\Http\Middleware\ResumeResponseBodyMiddleware;

use function React\Async\await;
use function React\Promise\Timer\sleep;

/** @internal */
final class ResumeResponseBodyMiddlewareTest extends AsyncTestCase
{
    /** @test */
    public function resume(): void
    {
        $body = Mockery::mock(HttpBodyStream::class);
        $body->expects('resume');

        $response = (new Response())->withBody($body);

        $next = static fn (): ResponseInterface => $response;

        $middleware = new ResumeResponseBodyMiddleware();
        await($middleware(new ServerRequest('GET', 'https://example.com/'), $next));

        // Force the future tick to happen
        await(sleep(0.001));
    }
}
