<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class ManageCategoryItems extends Component
{
    use WithPagination;

    public Category $category;
    public $q = '';
    public $showCreateModal = false;

    #[Rule('required|string|max:255')]
    public $name = '';
    #[Rule('nullable|string')]
    public $standard = '';
    #[Rule('nullable|string')]
    public $recommendation = '';

    public $editingItemId = null;
    #[Rule('required|string|max:255')]
    public $editingItemName = '';
    #[Rule('nullable|string')]
    public $editingItemStandard = '';
    #[Rule('nullable|string')]
    public $editingItemRecommendation = '';

    public function mount(Category $category)
    {
        $this->category = $category;
    }
    public function updatedQ()
    {
        $this->resetPage();
    }
    private function resetForm()
    {
        $this->reset('name', 'standard', 'recommendation');
    }
    public function createItem()
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }
    public function cancelEdit()
    {
        $this->reset('editingItemId', 'editingItemName', 'editingItemStandard', 'editingItemRecommendation');
    }

    public function storeItem()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'standard' => 'nullable|string',
            'recommendation' => 'nullable|string',
        ]);
        $this->category->items()->create([
            'name' => $this->name,
            'standard' => $this->standard,
            'recommendation' => $this->recommendation,
        ]);
        $this->showCreateModal = false;
        session()->flash('message', 'Item berhasil ditambahkan.');
    }

    public function editItem(Item $item)
    {
        $this->editingItemId = $item->id;
        $this->editingItemName = $item->name;
        $this->editingItemStandard = $item->standard;
        $this->editingItemRecommendation = $item->recommendation;
    }

    public function updateItem(Item $item)
    {
        $validated = $this->validate([
            'editingItemName' => 'required|string|max:255',
            'editingItemStandard' => 'nullable|string',
            'editingItemRecommendation' => 'nullable|string',
        ]);
        $item->update([
            'name' => $validated['editingItemName'],
            'standard' => $validated['editingItemStandard'],
            'recommendation' => $validated['editingItemRecommendation'],
        ]);
        $this->cancelEdit();
        session()->flash('message', 'Item berhasil diperbarui.');
    }

    public function deleteItem(Item $item)
    {
        $item->delete();
        session()->flash('message', 'Item berhasil dihapus.');
    }

    public function render()
    {
        $items = $this->category->items()
            ->when($this->q, function ($query) {
                $searchTerm = '%' . $this->q . '%';
                $query->where('name', 'ILIKE', $searchTerm)
                    ->orWhere('standard', 'ILIKE', $searchTerm)
                    ->orWhere('recommendation', 'ILIKE', $searchTerm);
            })
            ->latest()
            ->paginate(10);
        return view('livewire.admin.manage-category-items', ['items' => $items]);
    }

    public function highlight($text)
    {
        if (empty($this->q)) {
            return $text;
        }
        return preg_replace('/(' . preg_quote($this->q, '/') . ')/i', '<mark class="bg-yellow-200 rounded">$1</mark>', $text);
    }
}
