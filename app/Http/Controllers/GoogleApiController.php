<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// 
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\GoogleApiController;
// 
use App\Models\google_api;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class GoogleApiController extends Controller
{
    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){
         try{
            $user = Socialite::driver('google')->user();
            // dd($user);
            $is_user =  google_api::where('email', $user->getEmail())->first();
    
            if(!$is_user){
                $saveUser = google_api::updateorCreate([
                    'name' => $user->getName(),
                    'email' => $user->getemail(),
                    'password' => bcrypt("123456"),
                    ]);
                $saveUser->save();
                session()->put('id', $saveUser->id);
            }else{
                session()->put('id', $is_user->id);
            }
            return redirect('/');
        }catch(Exception $th){
            dd($th->getMessage());
        }
    }
}
