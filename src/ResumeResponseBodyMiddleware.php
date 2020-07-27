<?php

declare(strict_types=1);

namespace WyriHaximus\React\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\LoopInterface;
use React\Promise\PromiseInterface;
use React\Stream\ReadableStreamInterface;

use function React\Promise\resolve;

final class ResumeResponseBodyMiddleware
{
    private LoopInterface $loop;

    public function __construct(LoopInterface $loop)
    {
        $this->loop = $loop;
    }

    public function __invoke(ServerRequestInterface $request, callable $next): PromiseInterface
    {
        return resolve($next($request))->then(function (ResponseInterface $response): ResponseInterface {
            $body = $response->getBody();

            if ($body instanceof ReadableStreamInterface) {
                /** @psalm-suppress InvalidArgument */
                $this->loop->futureTick([$body, 'resume']);
            }

            return $response;
        });
    }
}
