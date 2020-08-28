<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function showHomepage()
    {
        return view('default.pages.homepage');
    }

    public function showCustomerAreaHomepage(Request $request)
    {
        if (! Customer::check($request)) {
            abort(404);
        }

        $customer = Customer::where('id', session()->get('customer_id'))->first();

        return view('default.pages.customer-area.homepage', ['customer' => $customer]);
    }

    public function showCustomerOrders(Request $request)
    {
        if (! Customer::check($request)) {
            abort(404);
        }

        $customer = Customer::where('id', session()->get('customer_id'))->first();

        return view('default.pages.customer-area.orders', [
                'customer'  => $customer,
                'orders'    => $customer->orders
            ]);
    } 

    public function showBackofficeHomepage()
    {
        return view('default.pages.backoffice.homepage');
    }

    public function showOrderTrackingPage()
    {
        return view('default.pages.order-tracking');
    }
}
