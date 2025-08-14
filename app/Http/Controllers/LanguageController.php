<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang(Request $request)
    {
        $lang = $request->input('lang');

        if (in_array($lang, ['en', 'es'])) {
            App::setLocale($lang);
            Session::put('locale', $lang);

            if (Auth::check()) {
                $user = Auth::user();
                $user->locale = $lang;
                $user->save();
            }
        }
        return redirect()->back();
    }

    
}