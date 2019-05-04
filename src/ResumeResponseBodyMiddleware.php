<?php declare(strict_types=1);

namespace WyriHaximus\React\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\LoopInterface;
use function React\Promise\resolve;
use React\Stream\ReadableStreamInterface;

final class ResumeResponseBodyMiddleware
{
    /** @var LoopInterface */
    private $loop;

    public function __construct(LoopInterface $loop)
    {
        $this->loop = $loop;
    }

    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        return resolve($next($request))->then(function (ResponseInterface $response) {
            $body = $response->getBody();

            if ($body instanceof ReadableStreamInterface) {
                $this->loop->futureTick([$body, 'resume']);
            }

            return $response;
        });
    }
}
