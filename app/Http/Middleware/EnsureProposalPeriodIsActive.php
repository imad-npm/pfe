<?php

namespace App\Http\Middleware;

use App\Models\ImportantDate;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Symfony\Component\HttpFoundation\Response;

class EnsureProposalPeriodIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $proposalDate=ImportantDate::where('type',"proposal")->first() ;
        
        if(!$proposalDate)
        return $next($request);


        if(!Carbon::now()->between($proposalDate->start,$proposalDate->end)) 
            return back()->with('error','The proposal period is not active. This action is not allowed outside the valid period.') ;
    
        return $next($request);
    }
}
