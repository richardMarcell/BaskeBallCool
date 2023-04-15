<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJoinRequest;
use App\Http\Resources\JoinResource;
use App\Models\Join;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    public function index() {
        $joinCollection = Join::get();

        return JoinResource::collection($joinCollection);
    }

    public function store(StoreJoinRequest $request) {
        $joinCollection = Join::create($request->validated());

        return new JoinResource($joinCollection);
    }
}
