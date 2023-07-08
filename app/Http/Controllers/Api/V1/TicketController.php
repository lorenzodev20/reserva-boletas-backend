<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return TicketResource::collection(Ticket::latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TicketRequest $request
     * @return JsonResponse
     */
    public function store(TicketRequest $request): JsonResponse
    {
        $rps = Ticket::create($request->validated());
        if ($rps) {
            return response()->json(['result' => true, 'message' => 'Ticket create succesfully', 'data' => $rps], 201);
        }
        return response()->json(['result' => false, 'message' => 'Error create to ticket', 'errors' => $rps], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return JsonResponse
     */
    public function show(Ticket $ticket): JsonResponse
    {
        return response()->json(['result' => true, 'message' => 'Ticket exists', 'data' => $ticket], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TicketRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(TicketRequest $request, $id): JsonResponse
    {
        $rps = Ticket::findOrFail($id)->update($request->all());
        if (!$rps) {
            return response()->json(['message' => 'Ticket not found', 'errors' => $rps], 404);
        }
        if ($rps) {
            return response()->json(['message' => 'Ticket modified succesfully', 'result' => $rps], 201);
        }
        return response()->json(['message' => 'Error to update ticket', 'errors' => $rps], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $ticket
     * @return JsonResponse
     */
    public function destroy(Ticket $ticket): JsonResponse
    {
        $ticket->delete();
        return response()->json(null, 204);
    }
}
