<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Exceptions\NotFoundException;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\CustomerUpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return CustomerResource::collection(Customer::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerRequest $request
     * @return JsonResponse
     */
    public function store(CustomerRequest $request): JsonResponse
    {
        $rps = Customer::create($request->validated());
        if ($rps) {
            return response()->json(['result' => true, 'message' => 'Customer create succesfully', 'data' =>  $rps], 201);
        }
        return response()->json(['result' => false, 'message' => 'Error to create customer', 'errors' => $rps], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $customer = Customer::find($id);
        if (!$customer) {
            throw new NotFoundException();
        }
        return response()->json(['result' => true, 'message' => 'Customer exists', 'data' => $customer], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomerUpdateRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(CustomerUpdateRequest $request, $id): JsonResponse
    {
        $rps = Customer::findOrFail($id)->update($request->all());
        if (!$rps) {
            return response()->json(['message' => 'Customer not found', 'errors' => $rps], 404);
        }
        if ($rps) {
            return response()->json(['message' => 'Customer modified succesfully', 'result' => $rps], 201);
        }
        return response()->json(['message' => 'Error to update customer', 'errors' => $rps], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return JsonResponse
     */
    public function destroy(Customer $customer): JsonResponse
    {
        $customer->delete();
        return response()->json("Customer deleted", 204);
    }
}
