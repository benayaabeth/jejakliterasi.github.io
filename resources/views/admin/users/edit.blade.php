@extends('layouts.admin')

@section('content')
<div class="container px-6 mx-auto">
    <div class="flex justify-between items-center my-6">
        <h1 class="text-3xl font-semibold text-gray-800">Edit Pengguna</h1>
        <a href="{{ route('admin.users.index') }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 flex items-center">
            <span class="mr-2">←</span> Kembali ke Manajemen Pengguna
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $user->name) }}"
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" 
                       name="username" 
                       id="username" 
                       value="{{ old('username', $user->username) }}"
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('username') border-red-500 @enderror">
                @error('username')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email', $user->email) }}"
                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="level" class="block text-gray-700 text-sm font-bold mb-2">Level</label>
                <select name="level" 
                        id="level" 
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('level') border-red-500 @enderror">
                    <option value="user" {{ old('level', $user->level) === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('level', $user->level) === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('level')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <button type="submit" 
                class="btn btn-sm btn-primary">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.users.index') }}" 
                class="btn btn-sm btn-danger">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection