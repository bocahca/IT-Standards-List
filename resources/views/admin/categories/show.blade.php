{{-- resources/views/admin/categories/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 space-y-6">

        {{-- Header: Kategori & Aksi --}}
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">{{ $category->name }}</h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.categories.index') }}"
                    class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                    ← Kembali
                </a>
            </div>
        </div>

        <div class="flex justify-end mb-4 space-x-2">
            <a href="#"
                class="inline-block px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-sm
            hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                + Tambah Item
            </a>
            <a href="{{ route('admin.categories.edit', $category) }}"
                class="inline-block px-4 py-2 bg-yellow-500 text-white font-semibold rounded-md shadow-sm
            hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition">
                Edit Kategori
            </a>
        </div>

        {{-- Tabel Item --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Item</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Standard</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Rekomendasi</th>
                            <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($category->items as $item)
                            <tr>
                                <td class="px-4 py-2 whitespace-nowrap">{{ $item->name }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ Str::limit($item->standard, 50) }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">{{ Str::limit($item->recommendation, 50) }}</td>
                                <td class="px-4 py-2 whitespace-nowrap space-x-2">
                                    <a href="#"
                                        class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                        Edit
                                    </a>
                                    <form action="#" method="POST" class="inline"
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
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500 italic">
                                    Belum ada item untuk kategori ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
