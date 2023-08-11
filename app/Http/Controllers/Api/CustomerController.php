<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): AnonymousResourceCollection
    {
        return CustomerResource::collection(Customer::latest()->get()); //Customer::all()
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): CustomerResource
    {
        $request->validate([
            'name' => 'required',
            'tel' => 'required',
            'is_favorite' => 'nullable|boolean'
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'tel' => $request->tel,
            'is_favorite' => $request->is_favorite ?? 0
        ]);

        return new CustomerResource($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer): CustomerResource
    {
        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer): CustomerResource
    {
        $request->validate([
            'name' => 'required',
            'tel' => 'required',
            'is_favorite' => 'required|boolean'
        ]);

        $customer->update($request->only(['name', 'tel', 'is_favorite']));

        return new CustomerResource($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer): Response
    {
        $customer->delete();
        
        return response()->noContent();
    }
}
