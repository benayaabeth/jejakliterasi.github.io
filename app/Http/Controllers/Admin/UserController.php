<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        }

        // Filter by level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Sort order
        $sortField = $request->get('sort', 'id');
        $sortOrder = $request->get('order', 'asc');
        $query->orderBy($sortField, $sortOrder);

        $users = $query->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
{
    return view('admin.users.edit', compact('user'));
}

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'level' => 'required|in:admin,user',
        ]);

        $user->update($request->only([
            'name',
            'username',
            'email',
            'level'
        ]));

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui');
    }

    public function destroy(User $user)
{
    if ($user->id === auth()->id()) {
        return back()->with('error', 'Tidak dapat menghapus akun sendiri');
    }

    // Hapus user
    $user->delete();

    // Reset auto increment dan update semua ID
    DB::statement('SET @count = 0;');
    DB::statement('UPDATE users SET id = @count:= @count + 1;');
    DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');

    return back()->with('success', 'Pengguna berhasil dihapus');
}
}