<?php

namespace App\Http\Controllers\Admin;

use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index($status)
    {
        $orders = Order::where('status', $status)->paginate('10');
        return view('admin.orders.orders', compact('orders', 'status'));
    }

    public function status($newStatus, $oid)
    {
        Order::find($oid)->update([
           'status' => $newStatus
        ]);

        return redirect()->back()->withMessage('Order Successfully '.ucwords($newStatus));
    }
}
