<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InsuredByInsurence
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $name = request()->route()->parameter('name');
        if (auth('insurence')->guest() || auth('insurence')->user()->insurence->name != $name){
            return redirect()->route('insurence.login', ['name' => $name]);
        }
        return $next($request);
    }
}
