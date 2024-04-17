<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders_by_user = $user->orders()->paginate(10);
        return Inertia::render('Dashboard', ['orders' => $orders_by_user]);
    }

    public function create()
    {
        $user = Auth::user();
        return Inertia::render('Create', ['user' => $user]);
    }

    public function upload(Request $request)
    {
        // dd($request);
        $user = Auth::user();
        if ($request->hasFile('stl_file')) {
            $file = $request->file('stl_file');
            $file_name = $file->getClientOriginalName();

            Order::create([
                'stl_file_path' => $file_name,
                'user_id' => $user->id,
            ]);

            $file->storeAs('file_ordini/' . $user->id, $file_name, 's3');
        }
    }
}
