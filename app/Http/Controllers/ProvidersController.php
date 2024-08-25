<?php
/*
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProvidersController extends Controller
{
    public function redirect(){
       return Socialite::driver('github')->stateless()->redirect();
    }
    public function callback(User $user){
         $github_user=Socialite::driver('github')->stateless()->user();
         $email=User::where('email',$github_user->email)->value('email');
         if(!empty($email)){
            Auth::login($user);
            return redirect()->route('home');
         }
         else{
             $field=[
                'github_id'=>$github_user->id,
                'username'=>$github_user->nickname,
                'email'=>$github_user->email,
                'github_token'=>$github_user->token
             ];
             $user=User::create($field);

             Auth::login($user);

             event(new Registered($user));

             return redirect()->route('view.set-password');
         }
    }
    public function set_password(Request $request,User $user){
        $request->validate([
            'password'=>['required','confirmed'],
        ]);
        $user->update(['password'=>$request->input('password')]);

        return redirect()->route('view.profile');
    }
}*/
