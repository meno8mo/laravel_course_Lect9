<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
//use App\Http\Requests\UpdateCategoryRequest;
;
//use ;

class languageManeger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('locale'))
        {
        \app()->setlocale(session()->get('locale'));
        }
        return $next($request);

    }
}
