<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Company;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("customers/index",[
            "companies" => Company::all(),
            "customers" => Customer::where("company_id",$request->company)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("customers/create",[
            "companies" => Company::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->fill($request->all());
        $customer->save();
        
        foreach ($request->addresses as $address) {
            $customer->addresses()->save(new CustomerAddress([
                "customer_id" => $customer->id,
                "address" => $address
            ]));
        }

        return redirect("customers")->with('success','Cliente agregado exitosamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("customers/edit",[
            "customer"  => Customer::find($id),
            "companies" => Company::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->fill($request->all());
        $customer->update();
        foreach ($request->addresses as $id => $address) {
            $ca = CustomerAddress::firstOrNew(["id" => $id]);
            $ca->address = $address;
            $ca->customer_id = $customer->id;
            $address == -1 ? $ca->delete() : $ca->save();
        }
        return redirect("customers?company=".$customer->company_id)->with('success','Cliente actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect("customers")->with('success','Cliente eliminado exitosamente');
    }
}
