<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        return Ticket::latest()->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
     * @param Request $request
     * @param Ticket $ticket
     * @return void
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
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
