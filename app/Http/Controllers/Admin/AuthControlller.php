<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use HashContext;
use Illuminate\Http\Request;
use \App\Models\User;
use Hash;

class AuthControlller extends Controller
{
    function create(){
        

        $user           = new User();
        $user->name     = 'Admin';
        $user->email    = 'admin@g.c';
        $user->password = Hash::make('admin');
        $user->save();

        $admin = Role::where('slug', 'admin')->first();

        $user->roles()->attach($admin);
    }
}
