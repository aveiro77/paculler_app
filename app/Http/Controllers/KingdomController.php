<?php

namespace App\Http\Controllers;

use App\Models\Kingdom;
use Illuminate\Http\Request;

class KingdomController extends Controller
{
    public function index()
    {
        $kingdoms = Kingdom::paginate(10);
        return view('kingdoms.index', compact('kingdoms'));
    }

    public function create()
    {
        return view('kingdoms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Kingdom::create($request->all());

        return redirect()->route('kingdoms.index')->with('success', 'Kingdom created successfully.');
    }

    public function show(Kingdom $kingdom)
    {
        return view('kingdoms.show', compact('kingdom'));
    }

    public function edit(Kingdom $kingdom)
    {
        return view('kingdoms.edit', compact('kingdom'));
    }

    public function update(Request $request, Kingdom $kingdom)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $kingdom->update($request->all());

        return redirect()->route('kingdoms.index')->with('success', 'Kingdom updated successfully.');
    }

    public function destroy(Kingdom $kingdom)
    {
        $kingdom->delete();
        return redirect()->route('kingdoms.index')->with('success', 'Kingdom deleted successfully.');
    }
}
