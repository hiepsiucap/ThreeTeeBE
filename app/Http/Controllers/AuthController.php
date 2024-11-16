<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\Registered;  
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // public function login(Request $request){
    //     $validated = $request->validate([
    //         'email'=>'required|email',
    //     ]);

    //     if(! Auth::attempt($validated)){
    //         return response()->json([
    //             'message'=>'Login information invalid'
    //         ],401);
    //     }

    //     $user = User::where('email', $validated['email'])->first();
    //     return response()->json([
    //         'access_token' => $user->createToken('api_token')->plainTextToken,
    //         'token_type' => 'Bearer'
    //     ]);
    // }

    public function register(Request $request){
        $data = $request->validate([
            'name' =>['required','string'],
            'email' =>['required','email','unique:users'],
            'password'=>['required','min:6'],
        ]);

        $user = User::create($data);

        event(new Registered($user));


        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(Request $request){
        $data = $request->validate([
            'email' =>['required','email','exists:users'],
            'password'=>['required','min:6'],
        ]);

        $user = User::where('email',$data['email'])->first();

        if(!$user || !Hash::check($data['password'], $user->password)){
            return response([
                'message' => 'Bad creds'
            ],401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
