{{-- resources/views/admin/items/create.blade.php --}}
@extends('layouts.app')
<title>@yield('title', 'IT Standards Category')</title>
@section('content')
    <div class="flex justify-center py-10">
        <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-6">
            {{-- Header --}}
            <div class="mb-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Tambah Item “{{ $category->name }}”</h1>
                <a href="{{ route('admin.categories.show', $category) }}" class="text-sm text-gray-600 hover:underline">
                    ← Kembali
                </a>
            </div>

            {{-- Error List --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.categories.items.store', $category) }}" method="POST">
                @csrf

                {{-- Nama Item --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Item</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Masukkan nama item…">
                </div>

                {{-- Standard --}}
                <div class="mb-4">
                    <label for="standard" class="block text-sm font-medium text-gray-700">Standard</label>
                    <textarea name="standard" id="standard" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Masukkan standard…">{{ old('standard') }}</textarea>
                </div>

                {{-- Recommendation --}}
                <div class="mb-6">
                    <label for="recommendation" class="block text-sm font-medium text-gray-700">Rekomendasi</label>
                    <textarea name="recommendation" id="recommendation" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Masukkan rekomendasi…">{{ old('recommendation') }}</textarea>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-2">
                    <button type="reset" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                        Reset
                    </button>
                    <button type="submit" onclick="this.disabled=true; this.form.submit();"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        Simpan Item
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
