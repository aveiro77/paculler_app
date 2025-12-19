<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Kingdom;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['category', 'kingdom'])->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = ItemCategory::all();
        $kingdoms = Kingdom::all();
        return view('items.create', compact('categories', 'kingdoms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:item_categories,id',
            'kingdom_id' => 'required|exists:kingdoms,id',
            'rate' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function show(Item $item)
    {
        $item->load(['category', 'kingdom']);
        return view('items.show', compact('item'));
    }

    public function edit(Item $item)
    {
        $categories = ItemCategory::all();
        $kingdoms = Kingdom::all();
        return view('items.edit', compact('item', 'categories', 'kingdoms'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:item_categories,id',
            'kingdom_id' => 'required|exists:kongdoms,id',
            'rate' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);

        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
