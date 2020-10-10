<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerStoreRequest;
use App\Traits\ApiResponser;

// 4|ilevhF8AWtu1WoxVa4bXqfs8Yn0twTun4AUG1Hg2

class CustomerController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        return DB::transaction(function()use($request){
            $customer = new Customer($request->only('company','name','email','phone'));
            $customer->save();
            return $this->successResponse([
                'message' => 'Cliente registrado',
            ],200);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerStoreRequest $request, Customer $customer)
    {
        return DB::transaction(function()use($request,$customer){
            $customer->fill($request->only('company','name','email','phone'));
            $customer->save();
            return $this->successResponse([
                'message' => 'Cliente actualizado',
            ],200);
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        return DB::transaction(function()use($customer){
            $customer->delete();
            return $this->successResponse([
                'message' => 'Cliente eliminado',
            ],200);
        });
    }
}
