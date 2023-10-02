<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json([
            "message" => "success",
            "data" => $user
        ]);
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            "username" => "string|required",
            "email" => "email|required",
            "password" => "required|min:6"
        ]);

        $checkUsername = User::where("username", $validateData["username"])->first();
        if ($checkUsername) {
            return response()->json([
                "status" => false,
                "message" => "username already exist",
                "data" => null
            ], 400);
        }

        $user = User::create([
            "username" => $validateData["username"],
            "email" => $validateData["email"],
            "password" => bcrypt($validateData["password"]),
            "role" => "user"
        ]);

        return response()->json([
            "status" => true,
            "message" => "register success",
            "data" => $user
        ]);
    }

    public function login(Request $request)
    {

        $credentials = request(["username", "password"]);

        $usernameFound = User::where("username", $credentials['username'])->first();
        if (!$usernameFound) {
            return response()->json([
                "status" => false,
                "message" => "username or password is invalid",
                "data" => null
            ], 404);
        }


        $passwordValid = Hash::check($credentials['password'], $usernameFound->password);
        if (!$passwordValid) {
            return response()->json([
                "status" => false,
                "message" => "username or password is invalid",
                "data" => null
            ], 404);
        }


        if ($usernameFound->role !== "admin") {
            return response()->json([
                "status" => false,
                "message" => "You are not admin",
                "data" => null
            ], 404);
        }

        $data = [
            "id" => $usernameFound->id,
            "username" => $usernameFound->username,
            "email" => $usernameFound->email,
            "role" => $usernameFound->role
        ];

        $customClaims = [
            "user" => $data
        ];

        $token = JWTAuth::claims($customClaims)->attempt($credentials);
        return response()->json([
            // "message" => "login success",
            $token
        ]);
    }

    public function loginApps(Request $request)
    {
        $usernameFound = User::where("username", $request->username)->first();
        if (!$usernameFound) {
            return response()->json([
                "status" => false,
                "message" => "username or password is invalid",
                "data" => null
            ], 404);
        }

        $passwordValid = Hash::check($request->password, $usernameFound->password);
        if (!$passwordValid) {
            return response()->json([
                "status" => false,
                "message" => "username or password is invalid",
                "data" => null
            ], 404);
        }

        $data = [
            "id" => $usernameFound->id,
            "username" => $usernameFound->username,
            "email" => $usernameFound->email,
            "role" => $usernameFound->role
        ];

        $customClaims = [
            "user" => $data
        ];

        $token = JWTAuth::claims($customClaims)->attempt($request->only("username", "password"));
        return response()->json([
            "status" => true,
            "message" => "login success",
            "token" => $token,
            "data" => $data
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                "message" => "user not found",
                "data" => null
            ], 404);
        }

        return response()->json([
            "message" => "success",
            "data" => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                "message" => "user not found",
                "data" => null
            ], 404);
        }

        $user->delete();
        return response()->json([
            "message" => "user deleted",
            "data" => $user
        ]);
    }

    public function forgotPassword(Request $request, $id)
    {
        $checkEmail = User::where("email", $request->email)->first();
        if (!$checkEmail) {
            return response()->json([
                "message" => "email not found",
                "data" => null
            ], 404);
        }

        $encode = [
            "email" => $checkEmail->email,
            "username" => $checkEmail->username,
            "id" => $checkEmail->id,
            "role" => $checkEmail->role
        ];

        ;

    }
}
