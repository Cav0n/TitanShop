<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

        return redirect()->back()->with(['success' => ['Votre message a été envoyé avec succés.']]);
    }
}
