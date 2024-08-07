<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
        return view('register');
    }
    public function login(){
        return view('login');
    }
    public function registerStore(Request $request){
        $request->validate([
            'name'=>['required','min:3','string'],
            'email'=>['required','unique:users,email'],
            'password'=>['required','min:8']

        ]);
        $name=$request->name;
        $email=$request->email;
        $password=$request->password;
        $user=User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            
        ]);
        Auth::login($user);
        return to_route('login');

    }
    public function loginStore(Request $request){
        $credentials=[
            'email'=>$request->email,
            'password'=>$request->password
        ];
        $user = User::where('email', $credentials['email'])->first();

        // التحقق من صحة كلمة المرور
        if ($user &&  $credentials['password']==$user->password) {
            if($user->rule=='admin'){
                return redirect('/admin');
            }
            return redirect('/');
        }

        return to_route('login')->with('message','Invalid mail or password');
    }

}
