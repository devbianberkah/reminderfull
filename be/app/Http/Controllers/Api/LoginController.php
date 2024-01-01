<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\LoginResource;
use App\Http\Resources\CommonErrorResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function index(){
        $logs = User::latest()->paginate(5);
        return new LoginResource(true,'List User',$logs);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()){
            return new CommonErrorResource(false,'ERR_INVALID_CREDS',$validator->errors());
        }

        $user = User::where('email', $request->email)->first();
        $data['user'] = $user;
        // $data['access_token'] = $user->createToken($request->email)->plainTextToken;
        // $data['refresh_token'] = $user->createToken($request->email)->plainTextToken;

        return new LoginResource(true, 'Data Post Berhasil Ditambahkan!', $data);
        // if (!user || Hash::check($request->password,$user->password)){
        //     throw ValidationException::withMessages([
        //         'email' => 'Salah password'
        //     ]);
        // }
      
    }
}
