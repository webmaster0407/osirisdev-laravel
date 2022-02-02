<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckTwoFactorRequest;
use App\Notifications\TwoFactorCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class TwoFactorController extends Controller
{
    public function show()
    {
        abort_if(auth()->user()->two_factor_code === null,
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );




        // Check if the provided code is correct for one click login
        // Get the user
        $user = auth()->user();

        // to get the current request object
        $request = request();

        if ($request->has('code')) {
            $code = $request->input('code');

            if ($code == $user->two_factor_code) {
                $user->resetTwoFactorCode();

                $route = (Route::has('frontend.home') && !$user->is_admin) ? 'frontend.home' : 'admin.home';

                return redirect()->route($route);
            }

            return redirect()->back()->withErrors(['two_factor_code' => __('global.two_factor.does_not_match')]);
        } else {
            // MPE: Added this because code was not sent
            auth()->user()->notify(new TwoFactorCodeNotification());

            //No code present, just show the page
            return view('auth.twoFactor');
        }



    }

    public function check(CheckTwoFactorRequest $request)
    {
        $user = auth()->user();

        if ($request->input('two_factor_code') == $user->two_factor_code) {
            $user->resetTwoFactorCode();

            $route = (Route::has('frontend.home') && !$user->is_admin) ? 'frontend.home' : 'admin.home';

            return redirect()->route($route);
        }

        return redirect()->back()->withErrors(['two_factor_code' => __('global.two_factor.does_not_match')]);
    }

    public function resend()
    {
        abort_if(auth()->user()->two_factor_code === null,
            Response::HTTP_FORBIDDEN,
            '403 Forbidden'
        );

        auth()->user()->notify(new TwoFactorCodeNotification());

        return redirect()->back()->with('message', __('global.two_factor.sent_again'));
    }
}
