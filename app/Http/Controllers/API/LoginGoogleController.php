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


class LoginGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // dd('nam');
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        // $user = Socialite::driver('google')->user();
        // dd($user);
        $userDetail = [];
        // try {
        $google_user = Socialite::driver('google')->user();
        // Auth::guard('google_clients')->attempt(['email' => $google_user->getEmail(), 'password' => Hash::make($google_user->getEmail() . '@' . $google_user->getName())]);
        $user = DB::table('google_clients')->where('google_id', $google_user->getId())->first();
        if ($user) {
            //Auth::guard('google_clients')->attempt(['email' => $google_user->getEmail(), 'password' => Hash::make($google_user->getEmail() . '@' . $google_user->getName())]);
            //dd(Auth::guard('google_clients')->attempt(['email' => $google_user->getEmail(), 'password' => Hash::make($google_user->getEmail() . '@' . $google_user->getName())]));
            // return redirect(route('user.home'));
            $userDetail = [
                'name' => $user->name,
                'email' => $user->email,
                'user_google_id'=>$user->google_id,
            ];
            session(['userGoogle' => $userDetail]);
            return redirect(route('user.home'));
        } else {
            $newUser = new GoogleUser();
            $newUser->name = $google_user->getName();
            $newUser->email = $google_user->getEmail();
            $newUser->google_id = $google_user->getId();
            $newUser->password = Hash::make($google_user->getEmail() . '@' . $google_user->getName());
            $newUser->save();
            // Auth::login($newUser);
            // Auth::check($user, true);
            // Auth::guard('google_clients')->attempt(['email' => $google_user->getEmail(), 'password' => Hash::make($google_user->getEmail() . '@' . $google_user->getName())]);
            session(['userGoogle' => $newUser]);
            return redirect(route('user.home'));
        }
        // return redirect(route('user.home'));
        // } catch (Throwable) {
        //     return redirect(route('user.login'));
        // }
    }
}
