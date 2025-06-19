<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('user.profile.edit', ['user' => auth()->user()]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'old_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        // Check old password if trying to change password
        if ($request->filled('new_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()
                    ->withErrors(['old_password' => 'Current password is incorrect'])
                    ->withInput();
            }
        }

        // Update basic info
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
        ];

        // Update password if provided
        if ($request->filled('new_password')) {
            $userData['password'] = Hash::make($request->new_password);
        }

        $user->update($userData);

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profile updated successfully');
    }

    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())
                      ->with(['orderDetails.book'])
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);

        return view('user.profile.orders', compact('orders'));
    }
}