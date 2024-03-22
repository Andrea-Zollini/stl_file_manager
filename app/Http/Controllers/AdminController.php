<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10)->through(function ($order) {
            return [
                'id' => $order->id,
                'stl_file_path' => $order->stl_file_path,
                'user_id' => $order->user_id,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'file_url' => Storage::disk('s3')->url('file_ordini/' . $order->user_id . '/' . $order->stl_file_path),
                'user' =>  User::where('id', $order->user_id)->get(),
            ];
        });
        return Inertia::render('Admin/Dashboard', ['orders' => $orders]);
    }
}
