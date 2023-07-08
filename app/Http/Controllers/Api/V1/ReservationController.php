<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        // return Reservation::latest()->paginate();
        return ReservationResource::collection(Reservation::with(['customer','ticket'])->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ReservationRequest $request
     * @return JsonResponse
     */
    public function store(ReservationRequest $request): JsonResponse
    {
        $rps = Reservation::create($request->validated());
        if ($rps) {
            return response()->json(['result' => true, 'message' => 'Reservation create succesfully', 'data' =>  $rps], 201);
        }
        return response()->json(['result'=> false, 'message' => 'Error to create reservation', 'errors' => $rps], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $data = new ReservationResource(Reservation::with(['customer','ticket'])->find($id));
        if($data){
            return response()->json(['result' => true, 'message' => 'Reservation exists', 'data' => $data], 200);
        }
        return response()->json(['message' => 'Reservation not found', 'errors' => $data], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Reservation $reservation
     * @return Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reservation $reservation
     * @return Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
