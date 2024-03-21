<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Admin extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('admin_login');
    }


    // protected function redirectTo(Request $request): ?string
    // {
    //     if (!$request->expectsJson()) {
    //         return route('admin_login');
    //     }
    // }

    // protected function redirectTo(Request $request): ?string
    // {
    //     if ($request->expectsJson()) {
    //         return null;
    //     } else {
    //         return route('admin_login');
    //     }
    // }
}
