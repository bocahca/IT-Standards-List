<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->input('q', '');

        $categories = Category::with('items')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'ILIKE', "%{$q}%") // untuk PostgreSQL, MySQL bisa 'like'
                        ->orWhereHas('items', function ($qi) use ($q) {
                            $qi->where('name', 'ILIKE', "%{$q}%")
                            ->orWhere('standard', 'ILIKE', "%{$q}%")
                            ->orWhere('recommendation', 'ILIKE', "%{$q}%");
                        });
                });
            })
            ->orderByDesc('created_at')
            ->paginate(5)
            ->appends(['q' => $q]);

        return view('admin.categories.index', compact('categories', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category =Category::create($data);

        return redirect()
            ->route('admin.categories.show', $category)
            ->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Category $category)
    {
        $q = $request->input('q');

        $items = $category
            ->items()
            ->when($q, function($query, $q) {
                return $query->whereLike('name', "%{$q}%");
            })
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('admin.categories.show', compact('category', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }

}
