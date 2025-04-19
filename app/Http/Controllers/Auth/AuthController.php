<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;

    public function loginUser(Request $request)
    {

        $validateUser = Validator::make($request->all(),[
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string|min:5'
        ]);

        if ($validateUser->fails()) {
            return $this->error($validateUser->errors()->first(),  400, []);
        }
        else{
            $cred = ['email' => $request->email, 'password' => $request->password];

            if(Auth::attempt($cred,false)){
                if( Auth::user()->hasRole('admin')){

                    return response()->json([
                        'status' => 200,
                        'message' => 'Admin logged in successfully',
                        'url' => route('admin.dashboard'),
                    ]);
                }
                else{
                    return $this->success([],'Access denied. Not an admin.');
                }
            }
            else{
                return $this->error('Invalid credentials',  401, []);
            }

        }
    }
}
