<?php

namespace App\Http\Controllers;

use App\Enums\StatusSelesai;
use App\Models\Order;
use Illuminate\Http\Request;

class BasketBallCourtsOrderController extends Controller
{
    
    public function index() 
    {
        $orderCollection = Order::where('status_selesai_id', '=', StatusSelesai::MASIH_BERMAIN->statusSelesai())->get();

        return view('basketball-courts-order.index', compact('orderCollection'));
    }

}