<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $recentActivity = match ($user->role) {
            'manager' => [
                'Monitor Dashboard',
                'Manage User',
                'Approve Data',
            ],
            'admin_operasional' => [
                'Create Shipment',
                'Assign Driver',
                'Manage Armada',
            ],
            'warehouse' => [
                'Create Inbound',
                'Create Outbound',
                'Update POD',
            ],
            'finance' => [
                'Login',
                'Create Invoice',
                'Add Payment',
                'Export Report',
            ],
            default => ['Login'],
        };

        return view('profile.index', compact('user', 'recentActivity'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:25'],
        ]);

        $user->update($validated);

        return Redirect::route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if (! Hash::check($validated['current_password'], $user->password)) {
            return Redirect::back()->withErrors(['current_password' => 'Password saat ini tidak cocok.'])->withInput();
        }

        $user->update(['password' => Hash::make($validated['password'])]);

        return Redirect::route('profile.index')->with('success', 'Password berhasil diperbarui.');
    }
}
