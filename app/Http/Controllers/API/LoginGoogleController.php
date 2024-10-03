<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\ErrorHandler\Throwing;
use Throwable;
use Illuminate\Support\Facades\DB;
use App\Models\User\GoogleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User\Customer;


class LoginGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // dd('nam');
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            // Auth::guard('google_clients')->attempt(['email' => $google_user->getEmail(), 'password' => Hash::make($google_user->getEmail() . '@' . $google_user->getName())]);
            $user = DB::table('customer')->where('google_id', $google_user->getId())->first();
            if ($user) {
                Auth::guard('customer')->loginUsingId($user->id);
                // if (Auth::guard('customer')->attempt(['email' => $user->email, 'password' => Hash::make($google_user->getEmail() . '@' . $google_user->getName())])) {
                //     return redirect(route('user.home'));
                // }
                // $userDetail = [
                //     'name' => $user->name,
                //     'email' => $user->email,
                //     'user_google_id' => $user->id,
                // ];
                // session(['userGoogle' => $userDetail]);
                return redirect(route('user.home'));
                // else {
                //     dd($user);
                //     // return redirect(route('user.login'));
                // }
            } else {
                $newUser = new Customer();
                $newUser->name = $google_user->getName();
                $newUser->email = $google_user->getEmail();
                $newUser->google_id = $google_user->getId();
                $newUser->password = Hash::make($google_user->getEmail() . '@' . $google_user->getName());
                $newUser->save();
                $userDetail = [];
                $detail = DB::table('customer')->get()->where('google_id', $google_user->getId())->first();
                // session(['userGoogle' => [
                //     'name' => $detail->name,
                //     'email' => $detail->email,
                //     'user_google_id' => $detail->id,
                // ]]);
                return redirect(route('user.home'));
            }
            // return redirect(route('user.home'));
        } catch (Throwable) {
            return redirect(route('user.login'));
        }
    }
}
