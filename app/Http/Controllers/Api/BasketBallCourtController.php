<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditCourtsRequest;
use App\Http\Requests\StoreCourtsRequest;
use App\Http\Resources\BasketBallCourtResource;
use App\Models\Court;
use Illuminate\Http\Request;

class BasketBallCourtController extends Controller
{
    
    public function index() {
        $courtCollection = Court::get();

        return BasketBallCourtResource::collection($courtCollection);
    }

    public function show(Court $court) {
        return new BasketBallCourtResource($court);
    }

    public function store(StoreCourtsRequest $request) {
        // CourtStoreRequest
        $courtCollection = Court::create($request->validated());

        return new BasketBallCourtResource($courtCollection);
    }

    public function update(EditCourtsRequest $request, Court $court) {
        $court->update($request->validated());

        return new BasketBallCourtResource($court);
    }

    public function destroy(Court $court) {
        $court->delete();

        return response()->noContent();
    }

}
