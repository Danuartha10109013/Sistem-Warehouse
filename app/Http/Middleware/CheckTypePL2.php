<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckTypePL2
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $type = json_decode($user->type, true);

            if ($user->role == 5 || $user->role == 0 || (is_array($type) && (in_array("PL2", $type) || in_array("all", $type)))) {
                return $next($request);
            }
            return response()->view('errors.custom', ['message' => 'You are not authorized to access this section'], 403);
        }
        return redirect('/');
    }
}
