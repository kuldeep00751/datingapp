<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;

class QuoteController extends Controller
{
    public function index()
    {
        $quotes = Quote::first();
        return view('admin.quotes.edit', compact('quotes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'author' => 'required|string',
        ]);

        // Always update the first (or only) quote
        $quote = Quote::first();

        if ($quote) {
            $quote->update([
                'text' => $request->input('text'),
                'author' => $request->input('author'),
            ]);
        } else {
            Quote::create([
                'text' => $request->input('text'),
                'author' => $request->input('author'),
            ]);
        }

        return redirect()->route('quotes.index')->with('success', 'Quote saved successfully.');
    }
}
