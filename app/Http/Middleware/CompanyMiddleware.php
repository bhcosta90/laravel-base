<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Services\CompanyService;
use Closure;
use Illuminate\Http\Request;

class CompanyMiddleware
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
        /**
         * @var CompanyService
         */
        $objService = app(CompanyService::class);
        $objCompany = $objService->getCompanyByDomain($request->getHost());
        if(empty($objCompany)) abort(404);
        
        $objService->alterConfig($objCompany);
        $objService->setDefaultConnection(true);

        return $next($request);
    }
}
