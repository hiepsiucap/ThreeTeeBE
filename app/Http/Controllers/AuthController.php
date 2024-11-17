<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $validated = $request->validate([
    //         'email' => 'required|email',
    //     ]);

    //     if (!Auth::attempt($validated)) {
    //         return response()->json([
    //             'message' => 'Login information invalid'
    //         ], 401);
    //     }

    //     $user = User::where('email', $validated['email'])->first();
    //     return response()->json([
    //         'access_token' => $user->createToken('api_token')->plainTextToken,
    //         'token_type' => 'Bearer'
    //     ]);
    // }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
        ]);

        $user = User::create($data);

        event(new Registered($user));


        $token = $user->createToken('auth_token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:6'],
        ]);

        // Lấy thông tin người dùng
        $user = User::where('email', $data['email'])->first();

        // Kiểm tra mật khẩu
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response([
                'message' => 'Thông tin đăng nhập không chính xác.',
            ], 401);
        }

        // Kiểm tra email đã xác minh hay chưa
        if (!$user->hasVerifiedEmail()) {
            return response([
                'message' => 'Tài khoản chưa được xác minh email. Vui lòng kiểm tra hộp thư của bạn.',
            ], 403);
        }

        // Tạo token xác thực
        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ], 200);
    }
}
