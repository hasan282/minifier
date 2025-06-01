<?php

namespace Hasan282\Minifier\Middleware;

use Closure;
use Hasan282\Minifier\Helper\Minify as MinifyHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Minify
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $instanceOfResponse = $response instanceof \Illuminate\Http\Response;

        $successfulResponse = $response->isSuccessful();

        $headerIsHtml = $response->getContent() !== false;

        if ($instanceOfResponse && $successfulResponse && $headerIsHtml) {

            $output = $response->getContent();

            $output = MinifyHelper::script($output);
            $output = MinifyHelper::style($output);
            $output = MinifyHelper::html($output);

            $response->setContent($output);
        }

        return $response;
    }
}
