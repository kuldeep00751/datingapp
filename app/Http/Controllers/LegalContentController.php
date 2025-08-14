<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LegalContent;

class LegalContentController extends Controller
{
    public function index()
    {
        $contents = LegalContent::all();
        return view('admin.legal_contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.legal_contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:Terms&Condition,Privacy',
            'locale' => 'required',
            'content' => 'required|string',
        ]);

        LegalContent::updateOrCreate(
            ['type' => $request->type, 'locale' => $request->locale],
            ['content' => $request->content]
        );

        return redirect()->route('legal-contents.index')->with('success', 'Content saved successfully.');
    }

    public function edit($id)
    {
        $content = LegalContent::findOrFail($id);
        return view('admin.legal_contents.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:Terms&Condition,Privacy',
            'locale' => 'required',
            'content' => 'required|string',
        ]);

        $content = LegalContent::findOrFail($id);
        $content->update($request->only('type', 'locale', 'content'));

        return redirect()->route('legal-contents.index')->with('success', 'Content updated successfully.');
    }

    public function show($id)
    {
        $content = LegalContent::findOrFail($id);
        return view('admin.legal_contents.show', compact('content'));
    }

    public function destroy($id)
    {
        LegalContent::findOrFail($id)->delete();
        return redirect()->route('legal-contents.index')->with('success', 'Content deleted successfully.');
    }

}
