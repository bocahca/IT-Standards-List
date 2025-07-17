{{-- resources/views/admin/categories/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 space-y-6">

        {{-- Header & Aksi --}}
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">{{ $category->name }}</h1>
            <a href="{{ route('admin.categories.index') }}" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">
                ← Kembali
            </a>
        </div>

        <div class="flex justify-between mb-6">
            {{-- Edit & Hapus Kategori --}}
            <div class="flex space-x-2">
                <a href="{{ route('admin.categories.edit', $category) }}"
                    class="px-4 py-2 bg-yellow-500 text-white rounded shadow-sm hover:bg-yellow-600 transition">
                    Edit Kategori
                </a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded shadow-sm hover:bg-red-600 transition">
                        Hapus Kategori
                    </button>
                </form>
            </div>

            {{-- Tambah Item (Primary CTA) --}}
            <a href="{{ route('admin.categories.items.create', $category) }}" class="px-4 py-2 bg-indigo-600 text-white rounded shadow-sm hover:bg-indigo-700 transition">
                + Tambah Item
            </a>
        </div>

        {{-- Tabel Item --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left border border-gray-300 border-collapse">
                    <thead class="bg-blue-200">
                        <tr>
                            <th class="px-4 py-3 text-xs font-medium text-gray-700 uppercase border border-gray-300">No</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-700 uppercase border border-gray-300">Item
                            </th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-700 uppercase border border-gray-300">
                                Standard</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-700 uppercase border border-gray-300">
                                Rekomendasi</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-700 uppercase border border-gray-300">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($items as $item)
                            <tr class="odd:bg-white even:bg-gray-50">
                                <td class="px-4 py-2 border border-gray-300">{{ $items->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $item->name }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $item->standard }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $item->recommendation }}</td>
                                <td class="px-4 py-2 border border-gray-300 space-x-2">
                                    <a href="{{ route('admin.categories.items.edit', [$category, $item]) }}"
                                        class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.categories.items.destroy', [$category, $item]) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500 italic">
                                    Belum ada item untuk kategori ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-4">
            {{ $items->links() }}
        </div>

    </div>
@endsection
