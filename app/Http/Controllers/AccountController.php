<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use Auth;
class AccountController extends Controller
{
    public function register(Request $req){

        $user = User::create($req->all());

        return new UserResource($user);
    }
    public function login(Request $req){

        
        if(Auth::attempt($req->all())){
            $token = $req->user()->createToken($req->email);

            return response()->json(['data'=>Auth::user(),'_token'=>$token->plainTextToken]);
        }
        return response()->json(['mess'=>'Sai thông tin đăng nhập'],401);
    }
}
