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
        return Inertia::render('Dashboard');
    }

    public function create()
    {
        $loggedUser = Auth::user();
        return Inertia::render('Create', ['user' => $loggedUser]);
    }

    public function upload(Request $request)
    {
        // dd($request);
        $loggedUser = Auth::user();
        if ($request->hasFile('stl_file')) {
            $file = $request->file('stl_file');
            $file_name = $file->getClientOriginalName();

            Order::create([
                'stl_file_path' => $file_name,
                'user_id' => $loggedUser->id,
            ]);

            $file->storeAs('file_ordini/' . $loggedUser->id, $file_name, 's3');
        }
    }
}
