<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;


class AdminDashboardController extends Controller
{
    use ApiResponse;
    public function index(){
        return view('admin.index');
    }

    public function destroy($table, string $id)
    {
        {
            $deleted = DB::table($table)->where('id', $id)->delete();
        
            if ($deleted) {
                
                return response()->json(['status' => 200, 'message' => 'Deleted successfully']);
            } else {
                return response()->json(['status' => 400, 'message' => 'Delete failed'], 400);
            }
        }
        
    }
}
