<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
      if ($request->user() === null) {
        return response('Unauthorized access', 401);
      }
      else if ($request->user()->hasRole('admin')) {
        return $next($request);
      }
      else {
        return back();
      }
    }
}
