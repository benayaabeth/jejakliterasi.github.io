@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="container px-6 mx-auto">
    <h1 class="text-3xl font-semibold text-gray-800 my-6">Edit Buku</h1>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
        <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Title --}}
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700">Judul Buku</label>
                    <input type="text" name="title" value="{{ old('title', $book->title) }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                           @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Author --}}
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700">Penulis</label>
                    <input type="text" name="author" value="{{ old('author', $book->author) }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                           @error('author') border-red-500 @enderror">
                    @error('author')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Synopsis --}}
                <div class="form-group col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Sinopsis</label>
                    <textarea name="synopsis" rows="4" 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                              @error('synopsis') border-red-500 @enderror">{{ old('synopsis', $book->synopsis) }}</textarea>
                    @error('synopsis')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="kategori" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                            @error('kategori') border-red-500 @enderror">
                        <option value="Novel" {{ $book->kategori == 'Novel' ? 'selected' : '' }}>Novel</option>
                        <option value="Komik" {{ $book->kategori == 'Komik' ? 'selected' : '' }}>Komik</option>
                        <option value="Pendidikan" {{ $book->kategori == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    </select>
                    @error('kategori')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Price --}}
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="price" value="{{ old('price', $book->price) }}" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                           @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Image Upload --}}
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700">Gambar Buku</label>
                    <input type="file" name="image" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                           @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    @if($book->image)
                        <div class="mt-2">
                            <p>Gambar Saat Ini:</p>
                            <img style="width: 300px;"  src="{{ Storage::url('public/books/'.$book->image) }}" alt="Buku">
                        </div>
                    @endif
                </div>

                {{-- PDF Upload --}}
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-700">File PDF</label>
                    <input type="file" name="pdf_file" 
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                           @error('pdf_file') border-red-500 @enderror">
                    @error('pdf_file')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    @if($book->pdf_file)
                        <div class="mt-2">
                            <p>File PDF Saat Ini: {{ $book->pdf_file }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="mt-6">
                <button type="submit" class="btn btn-sm btn-primary">
                    Perbarui Buku
                </button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-danger">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection