<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AcceptedRequestResource;
use App\Http\Resources\CommonErrorResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function index(){
        $logs = User::latest()->paginate(5);
        return new AcceptedRequestResource(true,'List User',$logs);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()){
            // return ;
            return response()->json(new CommonErrorResource(false,'ERR_INPUT',$validator->errors()), 401);
        }

        $user = User::where('email', $request->email)->first();
        if ( $user)
        {
            if (!Hash::check($request->password,$user->password)){
                return response()->json(new CommonErrorResource(false,'ERR_INVALID_CREDENTIAL','Wrong Password!'), 200);
            }
            $token = $user->createToken('authToken')->plainTextToken();
            $data['user'] = $user;
            $data['token'] = $token;
            $cookie = Cookie::make($this->AUTH_COOKIE_NAME, $token, $this->COOKIE_EXPIRE_TIME);
            return response()->json(new AcceptedRequestResource(true, 'Login Success!', $data), 200);   
        }
        else{
            return response()->json(new CommonErrorResource(false,'ERR_INVALID_CREDENTIAL','User not found!'), 401);
        }
    }
}
