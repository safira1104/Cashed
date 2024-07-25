<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectUppercaseURLs
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $uri = $request->getRequestUri();

        // Cek apakah URL mengandung huruf besar
        if (preg_match('/[A-Z]/', $uri)) {
            // Konversi URL ke huruf kecil dan redirect
            return redirect(strtolower($uri), 301);
        }

        return $next($request);
    }
}
