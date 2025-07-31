<div>
    {{-- Notifikasi Sukses --}}
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    {{-- Search & Tambah Item --}}
    <div class="flex justify-between items-center mb-6">
        <input type="text" wire:model.live.debounce.300ms="q" placeholder="Cari item..."
            class="px-6 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200" />
        <button wire:click="createItem"
            class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded shadow-sm hover:bg-indigo-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Item
        </button>
    </div>

    {{-- Tabel Item --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-blue-200">
                    <tr>
                        <th class="px-4 py-3 border text-left text-xs text-gray-700 uppercase">No</th>
                        <th class="px-4 py-3 border text-left text-xs text-gray-700 uppercase w-1/4">Item</th>
                        <th class="px-4 py-3 border text-left text-xs text-gray-700 uppercase w-1/3">Standard</th>
                        <th class="px-4 py-3 border text-left text-xs text-gray-700 uppercase w-1/3">Rekomendasi</th>
                        <th class="px-4 py-3 border text-center text-xs text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $index => $item)
                        <tr class="odd:bg-white even:bg-gray-50" wire:key="{{ $item->id }}">
                            @if ($editingItemId !== $item->id)
                                <td class="px-4 py-2 border text-center">{{ $items->firstItem() + $index }}</td>
                                <td class="px-4 py-2 border break-words">{!! $this->highlight($item->name) !!}</td>
                                <td class="px-4 py-2 border break-words">{!! $this->highlight($item->standard) !!}</td>
                                <td class="px-4 py-2 border break-words">{!! $this->highlight($item->recommendation) !!}</td>
                                <td class="px-4 py-2 border">
                                    <div class="flex justify-center space-x-2">
                                        <button wire:click="editItem({{ $item->id }})" title="Edit Item"
                                            class="p-1 bg-yellow-100 text-yellow-600 rounded-full hover:bg-yellow-200 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path
                                                    d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                            </svg>
                                        </button>
                                        {{-- TOMBOL HAPUS DENGAN IKON --}}
                                        <button wire:click="deleteItem({{ $item->id }})"
                                            wire:confirm="Yakin hapus item ini?" title="Hapus Item"
                                            class="p-1 bg-red-100 text-red-600 rounded-full hover:bg-red-200 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd"
                                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            @else
                                <td class="px-4 py-2 border text-center">{{ $items->firstItem() + $index }}</td>
                                <td class="p-1 border"><input type="text" wire:model="editingItemName"
                                        class="w-full border-gray-300 rounded-md"></td>
                                <td class="p-1 border">
                                    <textarea wire:model="editingItemStandard" class="w-full border-gray-300 rounded-md" rows="2"></textarea>
                                </td>
                                <td class="p-1 border">
                                    <textarea wire:model="editingItemRecommendation" class="w-full border-gray-300 rounded-md" rows="2"></textarea>
                                </td>
                                <td class="p-1 border">
                                    <div class="flex justify-center items-center space-x-2">
                                        {{-- TOMBOL SIMPAN DENGAN IKON --}}
                                        <button wire:click="updateItem({{ $item->id }})" title="Simpan"
                                            class="p-2 bg-green-100 text-green-600 rounded-full hover:bg-green-200 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-5">
                                                <path fill-rule="evenodd"
                                                    d="M19.916 4.626a.75.75 0 0 1 .208 1.04l-9 13.5a.75.75 0 0 1-1.154.114l-6-6a.75.75 0 0 1 1.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 0 1 1.04-.208Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                        {{-- TOMBOL BATAL --}}
                                        <button wire:click="cancelEdit" wire:confirm="reset perubahan?" title="Batal"
                                            class="p-2 bg-gray-100 text-gray-600 rounded-full hover:bg-gray-200 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-5">
                                                <path fill-rule="evenodd"
                                                    d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500 italic">Belum ada item.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $items->links() }}</div>

    {{-- Modal Tambah Item --}}
    @if ($showCreateModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg">
                <h2 class="text-xl font-bold mb-4">Tambah Item Baru</h2>
                <form wire:submit.prevent="storeItem">
                    {{-- Form fields... (tidak ada perubahan) --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nama Item</label>
                        <input type="text" wire:model="name" class="mt-1 block w-full rounded-md">
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Standard</label>
                        <textarea wire:model="standard" rows="3" class="mt-1 block w-full rounded-md"></textarea>
                        @error('standard')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Rekomendasi</label>
                        <textarea wire:model="recommendation" rows="3" class="mt-1 block w-full rounded-md"></textarea>
                        @error('recommendation')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="$set('showCreateModal', false)"
                            class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
