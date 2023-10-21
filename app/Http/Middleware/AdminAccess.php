<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $auth = Auth::user();
        if ($auth) {
            try{
                $user = User::findOrFail($auth->id);
                if ($user->role == 'admin') {
                    return $next($request);
                }
            } catch (\Exception $e) {
                return redirect(route('auth.login'))->with('info', 'Login first');
            }
        }
        


        return redirect(route('auth.login'))->with('info', 'Login first');
    }
}
