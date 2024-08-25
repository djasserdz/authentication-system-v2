<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callback(User $user){
        $google_user=Socialite::driver('google')->stateless()->user();
        $user=User::where('email',$google_user->email)->first();
        if($user){
           Auth::login($user);
           return redirect()->route('view.profile');
        }
        else{
            $field=[
               'google_id'=>$google_user->id,
               'username'=>$google_user->name,
               'email'=>$google_user->email,
            ];
            $user=User::create($field);

            Auth::login($user);

            event(new Registered($user));

            return redirect()->route('view.set-password');
        }
   }
   public function set(Request $request,User $user){
    $user=auth()->user();
    $request->validate([
        'password'=>['required','confirmed'],
    ]);
    $user->update(['password'=>$request->input('password')]);

    return redirect()->route('view.profile');
}
}
