<?php

namespace Hasan282\Minifier\Middleware;

use Closure;
use Illuminate\Http\Request;

class Minify
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (
            $response instanceof \Illuminate\Http\Response &&
            strpos($response->headers->get('Content-Type'), 'text/html') !== false
        ) {
            $output = $response->getContent();

            $output = preg_replace('/>\s+</', '><', $output);
            $output = preg_replace('/\s+/', ' ', $output);
            $output = trim($output);

            $response->setContent($output);
        }

        return $response;
    }
}
