<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponse;

class ProfileController extends Controller
{

    use ApiResponse;
    public function index()
    {
        return view('admin.profile');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedata = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'image'  => 'nullable|mimes:jpeg,png,jpg|max:5120'
        ]);
    
        if ($validatedata->fails()) {
            
            return $this->error($validatedata->errors()->first(),  400, []);
        }
    
        // Handle Image Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = 'images/' . Auth::id() . '.png';
            $request->image->move(public_path('/images'), $imagePath);
        }
        else{
            $imagePath = Auth::user()->image;
        }
    
        // Update or Create User
        $user = User::updateOrCreate(
            ['id' => Auth::id()],
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $imagePath, 
            ]
        );
    
        return $this->success([],'User updated successfully');

    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
