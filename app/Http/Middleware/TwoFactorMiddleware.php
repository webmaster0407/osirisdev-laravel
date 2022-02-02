<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class TwoFactorMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        if ($user && $user->two_factor_code) {
            if (Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $user->two_factor_expires_at)->lt(now())) {
                $user->resetTwoFactorCode();
                auth()->logout();

                return redirect()->route('login')->with('message', __('global.two_factor.expired'));
            }

            if (!$request->is('two-factor*')) {

                return redirect()->route('twoFactor.show');
            }
        }

        return $next($request);
    }
}
