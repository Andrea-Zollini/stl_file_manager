<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        $orders = $orders->map(function ($order) {
            $order->file_url = Storage::disk('s3')->url('file_ordini/' . $order->user->id . '/' . $order->stl_file_path);
            return $order;
        });
        return Inertia::render('Admin/Dashboard', ['orders' => $orders]);
    }
}
