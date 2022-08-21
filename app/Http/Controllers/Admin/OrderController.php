<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $repository;

    public function __construct(Order $order)
    {
        $this->repository = $order;

        $this->middleware(['can:orders']);
    }

    public function index()
    {
        return view('admin.pages.orders.index');
    }
}
