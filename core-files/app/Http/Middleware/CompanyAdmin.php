<?php

namespace App\Http\Middleware;

use App\Model\Company;
use Closure;
use Auth;

class CompanyAdmin
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
        return $request->user()->company_admin ? $next($request) : abort(404);
    }
}
