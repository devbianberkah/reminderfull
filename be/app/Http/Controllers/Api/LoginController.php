<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\LoginResource;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function index(){
        $logs = User::latest()->paginate(5);
        return new LoginResource(true,'List User',$logs);
    }
}
