<?php

namespace App\Http\Controllers\API\V1;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\V1\BaseController;

class AuthController extends BaseController
{
    //
    public function register(Request $request){
        //validasi
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()){
            return response()->json(['error'=>$validator->errors()],401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        //input data user ke database
        $user = User::create($input);
        //membuat token
        
        $success['token'] =  $user->createToken('Personal Access Token')->accessToken;
        $success['name']  = $user->name;
 
        return $this->sendResponse($success, 'User register successfully.');
    }
    /**
     * @ login function
     * body: username,password
     * 
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
         
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $tokenResult =  $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if($request->remember_me){
                $token->expires_at = Carbon::now()->addWeeks(1);
            }
            $token->save();
 
            return response()->json([
                'access_token'=>$tokenResult->accessToken,
                'token_type' => 'Bearer', 
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ]);
        }else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
 
    /**
     * @ logout function
     */
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json(['massage'=>'sucessfully logout'],200);
    }
}
