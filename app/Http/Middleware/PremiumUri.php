<?php

namespace App\Http\Middleware;

use Closure;

class PremiumUri
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $premium = [
            'cool' => 'http://yandex.ru'
        ];

        if(in_array($request->short, array_flip($premium))) {
            return redirect($premium[$request->short]);
        } else {
            return $next($request);
        }
    }
}
