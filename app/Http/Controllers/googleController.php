<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\facades\Auth;
use Exception;

class googleController extends Controller
{
    public function signupView()
    {
        return Socialite::driver('google')->redirect();
    }

    public function signup()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            }
            else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy'),
                ]);
                Auth::login($newUser);

                return redirect()->intended('home');
            }
        } 
        catch (Exception $e) {

            dd($e->getMessage());

        }
    }
}
