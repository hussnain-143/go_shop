<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Traits\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;

    public function loginUser(Request $request)
    {
        $validateUser = Validator::make($request->all(), [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string|min:5'
        ]);

        if ($validateUser->fails()) {
            return $this->error($validateUser->errors()->first(), 400, []);
        }

        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credentials, false)) {
            if (Auth::user()->hasRole('admin')) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Admin logged in successfully',
                    'url' => route('admin.dashboard'),
                ]);
            } else {
                return $this->success([], 'Access denied. Not an admin.');
            }
        }

        return $this->error('Invalid credentials', 401, []);
    }

    public function createUserApi(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'role' => 'required|string|exists:roles,slug'
        ]);

        if ($validateData->fails()) {
            return $this->error($validateData->errors()->first(), 400, []);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Attach role if exists
        $role = Role::where('slug', $request->role)->first();
        if ($role) {
            $user->roles()->attach($role);
        }

        if ($user) {
            return $this->success([
                'user' => $user,
                'message' => 'user create successfully'
            ], 'user create successfully');
        }

        return $this->error('User could not be created', 500, []);
    }

    public function loginApi(Request $request){
        $validateData = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5'
        ]);

        if($validateData->fails()){
            return $this->error($validateData->errors()->first(), 400, []);
        }
        $credentials = $request->only(['email', 'password']);
        $user = User::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return $this->error('Invalid credentials', 401, []);
            }
            $token = $user->createToken('API Token')->plainTextToken;
            return $this->success([
                'token' => $token,
                'user' => $user,
                'message' => 'User Login success fully'
                ], 'User Login successfully');
    }

    public function usergetApi(){
        $user = User::with('roles')->get();
        return $this->success([
            'user' => $user,
            'message' => 'User get successfully'
            ], 'User get successfully');    

    }

    public function userupdateApi(Request $request){
        $validateData = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validateData->fails()){
            return $this->error($validateData->errors()->first(), 400, []);
        }


        $user = Auth::user()->update(['name' => $request->name]);

    if($user){
        return $this->success([
            'user' => $request->user(),
            'message' => 'User update successfully'
            ], 'User update successfully');
    }

    }

    public function logoutApi(Request $request){

    }

}
