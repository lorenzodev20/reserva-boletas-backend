<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // Cargar Relaciones
        $customer = new CustomerResource($this->loadCount('customer'));
        $ticket = new CustomerResource($this->loadCount('ticket'));

        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'customer' => $customer->customer,
            'ticket' => $ticket->ticket,
            'created' => $this->created_at
        ];
    }
}
