<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BasketBallCourtsOrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class BasketBallCourtsOrderController extends Controller
{
    public function index() 
    {
        $orderCollection = Order::get();

        return BasketBallCourtsOrderResource::collection($orderCollection);
    }
}
