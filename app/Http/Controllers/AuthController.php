<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Illuminate\Support\Str;




class AuthController extends Controller
{

    public function register(Request $request) {
    
        $credentials = $request->only('email','name','password','password_confirmation');
    
        $validator = Validator::make($credentials, [ 
            'email' => 'required|string|unique:users,email',
            'name' => 'required|string',
            'password' => 'required|string|confirmed'
            ]);

        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()],400);
        }


        try {
            $createduser  = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => $request->password
            ]);

          
         } catch (\Throwable $th) {
            

        }



        
        $user = User::find($createduser->id);
        $id =  "id" . "$user->id" ;
        $token =    hash('sha256', Str::random(60));
        $token .= $id;
        $user->token = $token;
        $user->save();

    

        
        // $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => new UserResource($user),
        ];
        return response($response, 201);
    }



    // login func

    public function login(Request $request) {
        $credentials = $request->only( 'email', 'password');

        $rules = [ 
            'email' => 'required|string',
            'password' => 'required|string'
            ];
       
        $validator = Validator::make($credentials, $rules);

        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()],400);
        }
        // Check email
        $user = User::with('role')->where('email', $request['email'])->first();

        // Check password
        if(!$user || !Hash::check($request['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => new UserResource($user),
            'token' => $token
        ];

        return response($response, 200);
    }

    public function logout(Request $request) {
        $logout = $request->user()->currentAccessToken()->delete();
        if($logout) {
            return response()->json(["message" => "Successfuly logged out!"]);
        }
    }
}
