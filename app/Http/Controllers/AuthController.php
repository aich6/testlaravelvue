<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User
     */
   public function createUser(Request $request)
   {
    try{
        $validateUser = Validator::make($request->all(),
        [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        if($validateUser->fails()){
            return response()->json([
                'errors' => $validateUser->errors()
            ],422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->pasword),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            'user' => $user,
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ],200);
    }catch(\Throwable $th){

        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ],500);

    }

   }

   /**
    * Login The User
    * @param Request $request
    * @return User
    */
    public function loginUser(Request $request)
    {
       
        try{
           $user = User::where('email' , $request->email)->first();
            if(!$user ||!Hash::check($request->password , $user->password)){
                return response()->json([
                    'status' => false,
                    'message' => 'email or password dosnt match our records',
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'User LogedIn Successfully',
                'user' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ],200);
        }catch(\Throwable $th){

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);

        }
    }

    public function logout(){
       
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'status' => true,
            'message' => 'User Logout Successfully',
        ],200);
    }
}
