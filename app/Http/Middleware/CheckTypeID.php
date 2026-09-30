<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTypeID
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $type = json_decode($user->type, true);

            if (is_array($type) && (in_array("ID", $type) || in_array("all", $type))) {
                return $next($request);
            }
            return response()->view('errors.custom', ['message' => 'You are not authorized to access this section'], 403);
        }
        return redirect('/');
    }
}
