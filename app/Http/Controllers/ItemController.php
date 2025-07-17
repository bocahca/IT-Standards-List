<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Category $category)
    {
        // Logic to show form for creating an item under a specific category
        return view('admin.items.create', compact('category'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'standard' => 'nullable|string',
            'recommendation' => 'nullable|string'
        ]);

        $category->items()->create($data);

        return redirect()
            ->route('admin.categories.show', $category)
            ->with('success', 'Item berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.items.edit', compact('category', 'item'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category, Item $item)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'standard'       => 'nullable|string',
            'recommendation' => 'nullable|string',
        ]);

        $item->update($data);

        return redirect()
            ->route('admin.categories.show', $category)
            ->with('success', 'Item berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Item $item)
    {
        $item->delete();

        return redirect()
            ->route('admin.categories.show', $category)
            ->with('success', 'Item berhasil dihapus.');
    }
}
