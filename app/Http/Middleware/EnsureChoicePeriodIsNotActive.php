<?php

namespace App\Http\Middleware;

use App\Models\ImportantDate;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class EnsureChoicePeriodIsNotActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $choiceDate=ImportantDate::where('type',"choice")->first() ;
        if(!$choiceDate)
        return $next($request);

        if(Carbon::now()->between($choiceDate->start,$choiceDate->end)) 
            return back()->with('error','The choice period is active') ;

        return $next($request);
    }
}
