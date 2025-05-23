<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->redirectGuestsTo(function (Request $request){
            if ($request->is('team') || $request->is('team/*')) {
                return route('team.login.form') ;
            }
            if ($request->is('teacher') || $request->is('teacher/*')) {
                return route('teacher.login.form') ;
            }
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login.form') ;
            }
        });
        
         $middleware->redirectUsersTo(function (Request $request) {

            foreach (["admin","team","teacher"] as  $guard) {
                # code...
                if(auth($guard)->check())
                    return route("$guard.dashboard") ;
            }
        
         }
     ); 
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

    