<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    public function index()
    {
        $categories = ItemCategory::paginate(10);
        return view('item_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('item_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        ItemCategory::create($request->all());

        return redirect()->route('item_categories.index')->with('success', 'Item Category created successfully.');
    }

    public function show(ItemCategory $itemCategory)
    {
        return view('item_categories.show', compact('itemCategory'));
    }

    public function edit(ItemCategory $itemCategory)
    {
        return view('item_categories.edit', compact('itemCategory'));
    }

    public function update(Request $request, ItemCategory $itemCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $itemCategory->update($request->all());

        return redirect()->route('item_categories.index')->with('success', 'Item Category updated successfully.');
    }

    public function destroy(ItemCategory $itemCategory)
    {
        $itemCategory->delete();
        return redirect()->route('item_categories.index')->with('success', 'Item Category deleted successfully.');
    }
}
