<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Order;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index() {
        $orderCollection = Order::get();

        return BookingResource::collection($orderCollection);
    }

    public function store(StoreBookingRequest $request) {
        // CourtStoreRequest
        $orderCollection = Order::create($request->validated());

        return new BookingResource($orderCollection);
    }
}
