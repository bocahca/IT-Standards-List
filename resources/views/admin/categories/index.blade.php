{{-- resources/views/admin/categories/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-10 space-y-6">
        <div class="flex justify-between items-center mb-6">
            {{-- Search form + reset --}}
            <form method="GET" action="{{ route('admin.categories.index') }}" class="flex items-center space-x-2">
                <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari kategori..."
                    class="px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring focus:ring-indigo-200" />
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-r-md
                       hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-200 transition">
                    <!-- Heroicon: magnifying glass -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>

                    <span class="ml-2">Cari</span>
                </button>

                {{-- Reset link muncul jika ada query --}}
                @if (request()->filled('q'))
                    <a href="{{ route('admin.categories.index') }}"
                        class="px-3 py-2 bg-gray-100 text-gray-600 rounded hover:bg-gray-200 transition">
                        kembali
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
            <a href="{{ route('admin.categories.show', $category) }}"
                class="block bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition cursor-pointer">
                {{-- Header Kategori --}}
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h2>
                </div>

                {{-- Preview Items --}}
                @if ($category->items->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left divide-y divide-gray-200 ">
                            <thead class="bg-blue-200">
                                <tr>
                                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Item</th>
                                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Standard</th>
                                    <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Rekomendasi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($category->items->take(4) as $item)
                                    <tr>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $item->name }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ Str::limit($item->standard, 50) }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ Str::limit($item->recommendation, 50) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 italic">Belum ada item untuk kategori ini.</p>
                @endif
                {{-- View More --}}
                <div class="mt-4 text-right">
                    <span class="text-indigo-600 font-medium hover:underline">
                        View Detail &raquo;
                    </span>
                </div>
            </a>
        @empty
            <p class="text-center text-gray-500 italic">Belum ada kategori.</p>
        @endforelse

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    </div>
@endsection
