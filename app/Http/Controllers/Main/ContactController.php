<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show contact page
     *
     * @return void
     */
    public function show()
    {
        return view('themes.default.pages.public.contact');
    }

    /**
     * Send message from contact form
     *
     * @return void
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:filter',
            'message' => 'required|min:10',
        ]);

        //return (new \App\Mail\ContactMessage($request['name'], $request['message'], $request['email']))->render();

        Mail::to(\App\Setting::valueOrNull('SHOP_EMAIL'))->send(
            new ContactMessage($request['name'], $request['email'], $request['message']));

        return redirect()->back()->with(['success' => ['Votre message a été envoyé avec succés.']]);
    }
}
