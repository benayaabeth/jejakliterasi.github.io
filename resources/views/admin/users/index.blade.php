@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="container px-6 mx-auto">
    <h1 class="text-2xl font-semibold text-gray-800 my-6">Manajemen Pengguna</h1>

    <!-- Search and Filter Section -->
    <div class="mb-6">
        <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-4">
            <div class="flex-1">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Cari username atau email..." 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            <div class="w-48">
                <select name="level" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                    <option value="">Semua Level</option>
                    <option value="admin" {{ request('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('level') == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
            <button type="submit" 
                    class="btn btn-sm btn-primary">
                Cari
            </button>
            @if(request('search') || request('level') || request('sort'))
                <a href="{{ route('admin.users.index') }}" 
                   class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Users Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-md">
        <div class="w-full overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="text-left bg-gray-100">
                        <th class="px-4 py-3">
                            <a href="{{ route('admin.users.index', array_merge(request()->query(), [
                                'sort' => 'id',
                                'order' => request('sort') === 'id' && request('order') === 'asc' ? 'desc' : 'asc'
                            ])) }}" class="flex items-center">
                                ID
                                @if(request('sort') === 'id')
                                    <span class="ml-1">
                                        @if(request('order') === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    </span>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3">
                            <a href="{{ route('admin.users.index', array_merge(request()->query(), [
                                'sort' => 'name',
                                'order' => request('sort') === 'name' && request('order') === 'asc' ? 'desc' : 'asc'
                            ])) }}" class="flex items-center">
                                Nama
                                @if(request('sort') === 'name')
                                    <span class="ml-1">
                                        @if(request('order') === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    </span>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3">
                            <a href="{{ route('admin.users.index', array_merge(request()->query(), [
                                'sort' => 'username',
                                'order' => request('sort') === 'username' && request('order') === 'asc' ? 'desc' : 'asc'
                            ])) }}" class="flex items-center">
                                Username
                                @if(request('sort') === 'username')
                                    <span class="ml-1">
                                        @if(request('order') === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    </span>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Level</th>
                        <th class="px-4 py-3">
                            <a href="{{ route('admin.users.index', array_merge(request()->query(), [
                                'sort' => 'created_at',
                                'order' => request('sort') === 'created_at' && request('order') === 'asc' ? 'desc' : 'asc'
                            ])) }}" class="flex items-center">
                                Terdaftar
                                @if(request('sort') === 'created_at')
                                    <span class="ml-1">
                                        @if(request('order') === 'asc')
                                            ↑
                                        @else
                                            ↓
                                        @endif
                                    </span>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $user->id }}</td>
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->username }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full {{ $user->level === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $user->level }}
                                </span>
                            </td>
                            <td class="px-4 py-3">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3">
                                    <a href="{{ route('admin.users.edit', $user) }}" 
                                       class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                    
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                Tidak ada data pengguna yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 bg-white border-t">
            {{ $users->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}
        </div>
    </div>
</div>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            showConfirmButton: true
        });
    </script>
@endif
@endsection