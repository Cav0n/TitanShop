<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerAreaController extends Controller
{
    /**
     * Show login page
     *
     * @return void
     */
    public function show()
    {
        return view('themes.default.pages.customer-area.index');
    }

    /**
     * Show personal informations modication modal
     *
     * @return void
     */
    public function personalInformationsModal()
    {
        $user = Auth::user();
        return view('themes.default.components.modals.personal-informations-modification')->with(['user' => $user])->render();
    }

    /**
     * Show password modification modal
     *
     * @return void
     */
    public function passwordModal()
    {
        $user = Auth::user();
        return view('themes.default.components.modals.password-modification')->with(['user' => $user])->render();
    }
}
