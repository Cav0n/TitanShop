<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function editPassword(Request $request)
    {
        if (! Customer::check($request)) {
            abort(404);
        }

        $customer = Customer::where('id', session()->get('customer_id'))->first();

        return view('default.pages.customer-area.password-edition', ['customer' => $customer]);
    }

    public function updatePassword(Request $request)
    {
        if (! Customer::check($request)) {
            return back()->withErrors(['Vous devez être connecté pour modifier vos informations personnelles.']);
        }

        if (null === $customer = Customer::where('id', $request->session()->get('customer_id'))->first()) {
            return back()->withErrors(['Vous devez être connecté pour modifier vos informations personnelles.']);
        }

        if (! Hash::check($request['actual_password'], $customer->password)) {
            return back()->withErrors(['Mot de passe actuel incorrect.']);
        }

        $customer->password = Hash::make($request['new_password']);
        $customer->save();

        $request->session()->put('customer_hash', Hash::make($customer->email . $customer->password));

        return back()->withSuccess('Mot de passe modifié avec succès.');
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('default.pages.backoffice.customers', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('default.pages.backoffice.customer', ['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer = null)
    {
        if (null === $customer) {
            if (! Customer::check($request)) {
                return back()->withErrors(['Vous devez être connecté pour modifier vos informations personnelles.']);
            }

            if (null === $customer = Customer::where('id', $request->session()->get('customer_id'))->first()) {
                return back()->withErrors(['Vous devez être connecté pour modifier vos informations personnelles.']);
            }
        }

        $customer->firstname = $request['firstname'];
        $customer->lastname = $request['lastname'];
        $customer->phone = $request['phone'];
        $customer->save();
        
        if ($customer->email !== $request['email']) {
            // SEND EMAIL TO ACTUAL EMAIL ADDRESS
        }
        
        return back()->withSuccess('Informations personnelles modifiées avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
