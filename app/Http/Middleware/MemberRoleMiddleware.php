<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MemberRoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if member is authenticated under the "member" guard
        $member = Auth::guard('member')->user();

        if (!$member) {
            return redirect()->route('member.login'); // redirect if not logged in
        }

        // Check if member role is in allowed roles
        if (!in_array($member->role, $roles)) {
            abort(403, 'Unauthorized.'); // or redirect somewhere
        }

        return $next($request);
    }
}
