<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
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
        // return Customer::latest()->paginate();
        return CustomerResource::collection(Customer::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerRequest $request
     * @return JsonResponse
     */
    public function store(CustomerRequest $request)
    {
        $rps = Customer::create($request->validated());
        if ($rps) {
            return response()->json(['message' => 'Customer create succesfully', 'result' => $rps], 201);
        }
        return response()->json(['message' => 'Error to create customer', 'errors' => $rps], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return Customer
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Customer $customer
     * @param $id
     * @return JsonResponse
     */
    public function update(Customer $customer, CustomerRequest $request, $id): JsonResponse
    {
        $customerFind = Customer::find($id);

        if (!$customerFind){
            return response()->json(['message' => 'Customer not found', 'errors' => $customerFind], 404);
        }
        /*if ($rps) {
            return response()->json(['message' => 'Customer create succesfully', 'result' => $rps], 201);
        }*/
        return response()->json(['message' => 'Error to update customer', 'errors' => $customerFind], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return JsonResponse
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response()->json(null, 204);
    }
}
