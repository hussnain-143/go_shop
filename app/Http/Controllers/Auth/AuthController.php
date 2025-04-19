<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Mime\Email;
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

    public function createUserApi(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email', 
            'password' => 'required|min:5',
            'role' => 'required|exists:roles,id'  
        ]);
    
        if ($validateData->fails()) {
            return $this->error($validateData->errors()->first(), 400, []);
        }
    
        // Hashing the password before storing
        $user = User::create([
            'name' => $request->name ?? 'Guest',
            'email' => $request->email,
            'password' => $request->password,
        ]);
    
        // Assigning role
        $role = Role::find($request->role); // Using role ID passed in request
        if ($role) {
            $user->roles()->attach($role);
        }
    
        if ($user) {
            return $this->success([
                'token' => $user->createToken('API Token')->plainTextToken,
                'user' => $user
            ], 201);
        }
    
        return $this->error('User could not be created', 500, []);
    }
    
}
