{{-- resources/views/admin/categories/show.blade.php --}}
@extends('layouts.app')
<title>@yield('title', 'IT Standards Category')</title>
@section('content')
    <div class="container mx-auto py-10 space-y-6">

        {{-- Judul & Aksi Kategori --}}
        <div class="flex justify-between items-center mb-6">
            {{-- Judul + Edit/Hapus --}}
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold">{{ $category->name }}</h1>

                {{-- Tombol Edit --}}
                <a href="{{ route('admin.categories.edit', $category) }}"
                    class="p-2 bg-yellow-100 text-yellow-600 rounded-full hover:bg-yellow-200 transition"
                    title="Edit Kategori">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path
                            d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                    </svg>

                </a>

                {{-- Tombol Hapus --}}
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 mt-4 bg-red-100 text-red-600 rounded-full hover:bg-red-200 transition"
                        title="Hapus Kategori">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                clip-rule="evenodd" />
                        </svg>

                    </button>
                </form>
            </div>

            {{-- Tombol Kembali --}}
            <a href="{{ route('admin.categories.index') }}"
                class="px-3 py-1 mt-4 bg-gray-200 rounded hover:bg-gray-300 transition">
                ← Kembali
            </a>
        </div>

        {{-- Search & Tambah Item --}}
        <div class="flex justify-between items-center mb-6">
            {{-- Search Form --}}
            <form method="GET" action="{{ route('admin.categories.show', $category) }}"
                class="flex items-center space-x-2 mb-6">
                <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari item..."
                    class="px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring focus:ring-indigo-200" />
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-r-md
                   hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-200 transition">
                    <!-- Search Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>

                    <span class="ml-2">Cari</span>
                </button>

                @if (request()->filled('q'))
                    <a href="{{ route('admin.categories.show', $category) }}"
                        class="px-3 py-2 bg-gray-100 text-gray-600 rounded hover:bg-gray-200 transition">
                        Tampilkan Semua
                    </a>
                @endif
            </form>

            {{-- Tambah Item --}}
            <a href="{{ route('admin.categories.items.create', $category) }}"
                class="flex items-center px-4 py-2 bg-indigo-600 text-white rounded shadow-sm hover:bg-indigo-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>

                Tambah Item
            </a>
        </div>

        {{-- Tabel Item --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full table-fixed border border-gray-300 border-collapse">
                    <colgroup>
                        <col style="width:5%">
                        <col style="width:20%">
                        <col style="width:37%">
                        <col style="width:25%">
                        <col style="width:13%">
                    </colgroup>
                    <thead class="bg-blue-200">
                        <tr>
                            <th class="px-4 py-3 border border-gray-300 text-xs text-gray-700 uppercase">No</th>
                            <th class="px-4 py-3 border border-gray-300 text-xs text-gray-700 uppercase">Item</th>
                            <th class="px-4 py-3 border border-gray-300 text-xs text-gray-700 uppercase">Standard</th>
                            <th class="px-4 py-3 border border-gray-300 text-xs text-gray-700 uppercase">Rekomendasi</th>
                            <th class="px-4 py-3 border border-gray-300 text-xs text-gray-700 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            <tr class="odd:bg-white even:bg-gray-50">
                                <td class="px-4 py-2 border border-gray-300">
                                    {{ $items->firstItem() + $loop->index }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 break-words whitespace-normal">
                                    {{ $item->name }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 break-words whitespace-normal">
                                    {{ $item->standard }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300 break-words whitespace-normal">
                                    {{ $item->recommendation }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300">
                                    <div class="flex justify-center space-x-2">
                                        {{-- Edit Item --}}
                                        <a href="{{ route('admin.categories.items.edit', [$category, $item]) }}"
                                            class="inline-flex items-center justify-center h-8 w-8 bg-yellow-100 text-yellow-600 rounded-full hover:bg-yellow-200 transition"
                                            title="Edit Item">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="size-6">
                                                <path
                                                    d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                            </svg>
                                        </a>

                                        {{-- Hapus Item --}}
                                        <form action="{{ route('admin.categories.items.destroy', [$category, $item]) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus item ini?')"
                                            class="inline-flex items-center">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center h-8 w-8 bg-red-100 text-red-600 rounded-full hover:bg-red-200 transition"
                                                title="Hapus Item">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="size-6">
                                                    <path fill-rule="evenodd"
                                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
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

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $items->links() }}
        </div>

    </div>
@endsection
