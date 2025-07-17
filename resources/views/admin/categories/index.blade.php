{{-- resources/views/admin/categories/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 space-y-6">
    @forelse($categories as $category)
        <div class="bg-white shadow-lg rounded-lg p-6">
            <!-- Header Kategori dan Aksi -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">{{ $category->name }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.categories.show', $category) }}" class="px-3 py-1 bg-indigo-500 text-white rounded hover:bg-indigo-600 transition">Lihat</a>
                    <a href="{{ route('admin.categories.edit', $category) }}" class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">Update</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">Hapus</button>
                    </form>
                </div>
            </div>

            <!-- Preview Items -->
            @if($category->items->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Item</th>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Standard</th>
                                <th class="px-4 py-2 text-xs font-medium text-gray-500 uppercase">Rekomendasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($category->items->take(4) as $item)
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ $item->name }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ Str::limit($item->standard, 50) }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap">{{ Str::limit($item->recommendation, 50) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 italic">Belum ada item untuk kategori ini.</p>
            @endif
        </div>
    @empty
        <p class="text-center text-gray-500 italic">Belum ada kategori.</p>
    @endforelse

    <!-- Pagination -->
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
@endsection
