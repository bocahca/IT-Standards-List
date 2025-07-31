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

        <livewire:admin.manage-category-items :category="$category" />
    @endsection
