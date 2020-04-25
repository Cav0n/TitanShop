<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Address::where('isDeleted', 0)->get();
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
     * @return Address
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'street' => 'required|min:2',
            'street2' => 'nullable|min:2',
            'zipCode' => 'required|min:4|max:5',
            'city' => 'required|min:2',
        ]);

        $address = new Address();
        $address->firstname = $request['firstname'];
        $address->lastname = $request['lastname'];
        $address->street = $request['street'];
        $address->street2 = $request['street'];
        $address->zipCode = $request['zipCode'];
        $address->city = $request['city'];

        $address->save();

        return $address;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $request->validate([
            'firstname' => 'required|min:2',
            'lastname' => 'required|min:2',
            'street' => 'required|min:2',
            'street2' => 'nullable|min:2',
            'zipCode' => 'required|min:4|max:5',
            'city' => 'required|min:2',
        ]);

        $address->firstname = $request['firstname'];
        $address->lastname = $request['lastname'];
        $address->street = $request['street'];
        $address->street2 = $request['street'];
        $address->zipCode = $request['zipCode'];
        $address->city = $request['city'];

        $address->save();

        return $address;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address->isDeleted = 1;
        $address->save();
    }
}
