{{-- resources/views/admin/categories/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 space-y-6">
        <div class="flex justify-between items-center mb-6">
            {{-- Search form + reset --}}
            <form method="GET" action="{{ route('admin.categories.index') }}" class="flex items-center space-x-2">
                <input type="text" name="q" value="{{ $q }}" placeholder="Cari keyword..."
                    class="px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring focus:ring-indigo-200" />
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-r-md
                           hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-200 transition">
                    <!-- icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <span class="ml-2">Cari</span>
                </button>

                @if (request()->filled('q'))
                    <a href="{{ route('admin.categories.index') }}"
                        class="px-3 py-2 bg-gray-100 text-gray-600 rounded hover:bg-gray-200 transition">
                        Tampilkan Semua
                    </a>
                @endif
            </form>

            {{-- Tombol Tambah Kategori --}}
            <a href="{{ route('admin.categories.create') }}"
                class="inline-block px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow-sm
                       hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                + Tambah Kategori
            </a>
        </div>

        @forelse($categories as $category)
            <div x-data="{ open: false }" class="bg-white shadow rounded-lg p-6 relative">
                {{-- Header --}}
                <div class="flex items-center mb-4 space-x-2">
                    <h2 class="text-xl font-semibold">{!! preg_replace('/(' . preg_quote($q, '/') . ')/i', '<span class="bg-yellow-200">$1</span>', e($category->name)) !!}</h2>
                    <a href="{{ route('admin.categories.show', $category) }}"
                        class="p-2 bg-yellow-100 text-yellow-600 rounded-full hover:bg-yellow-200 transition"
                        title="Detail Kategori">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                            <path
                                d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                        </svg>

                    </a>
                </div>

                {{-- Tabel items --}}
                <div class="overflow-x-auto pb-12">
                    <table class="min-w-full table-fixed divide-y divide-gray-200">
                        <colgroup>
                            <col style="width:5%">
                            <col style="width:20%">
                            <col style="width:40%">
                            <col style="width:35%">
                        </colgroup>
                        <thead class="bg-blue-200">
                            <tr>
                                <th class="px-4 py-2 text-xs uppercase">No</th>
                                <th class="px-4 py-2 text-xs uppercase">Item</th>
                                <th class="px-4 py-2 text-xs uppercase">Standard</th>
                                <th class="px-4 py-2 text-xs uppercase">Rekomendasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($category->items as $item)
                                <tr x-show="open || {{ $loop->index }} < 4" x-cloak class="odd:bg-white even:bg-gray-50">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2 break-words">{!! preg_replace('/(' . preg_quote($q, '/') . ')/i', '<span class="bg-yellow-200">$1</span>', e($item->name)) !!}</td>
                                    <td class="px-4 py-2 break-words">{!! preg_replace('/(' . preg_quote($q, '/') . ')/i', '<span class="bg-yellow-200">$1</span>', e($item->standard)) !!}</td>
                                    <td class="px-4 py-2 break-words">{!! preg_replace('/(' . preg_quote($q, '/') . ')/i', '<span class="bg-yellow-200">$1</span>', e($item->reccomendation)) !!}</td>
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

                {{-- Toggle detail button --}}
                <button + @click="open = !open"
                    class="absolute bottom-4 right-4 flex items-center space-x-1 p-2 bg-indigo-100 text-indigo-600 rounded-full hover:bg-indigo-200 transition"
                    :title="open ? 'Sembunyikan detail' : 'Tampilkan detail'">
                    <span class="text-sm font-medium" x-text="open ? 'Sembunyikan Detail' : 'View Detail'">
                        + </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform"
                        :class="open ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" + stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
        @empty
            <p class="text-center text-gray-500 italic">Belum ada kategori.</p>
        @endforelse

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
