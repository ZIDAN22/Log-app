<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        $query = Driver::query();

        if ($search = $request->query('search')) {
            $query->where(function ($sub) use ($search) {
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('license_number', 'like', "%{$search}%");
            });
        }

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $drivers = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'license_number' => 'required|string|max:100',
            'license_type' => ['required', Rule::in(Driver::licenseTypes())],
            'address' => 'nullable|string|max:1000',
            'status' => ['required', Rule::in(Driver::statuses())],
            'photo' => 'nullable|image|max:2048',
        ]);

        $driverData = [
            'code' => Driver::generateCode(),
            'name' => $data['name'],
            'phone' => $data['phone'],
            'license_number' => $data['license_number'],
            'license_type' => $data['license_type'],
            'address' => $data['address'] ?? null,
            'status' => $data['status'],
        ];

        if ($request->hasFile('photo')) {
            $driverData['photo_path'] = $request->file('photo')->store('driver_photos', 'public');
        }

        Driver::create($driverData);

        return redirect()->route('drivers.index')
            ->with('success', 'Driver berhasil ditambahkan.');
    }

    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'license_number' => 'required|string|max:100',
            'license_type' => ['required', Rule::in(Driver::licenseTypes())],
            'address' => 'nullable|string|max:1000',
            'status' => ['required', Rule::in(Driver::statuses())],
            'photo' => 'nullable|image|max:2048',
        ]);

        $driver->fill([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'license_number' => $data['license_number'],
            'license_type' => $data['license_type'],
            'address' => $data['address'] ?? null,
            'status' => $data['status'],
        ]);

        if ($request->hasFile('photo')) {
            if ($driver->photo_path) {
                Storage::disk('public')->delete($driver->photo_path);
            }
            $driver->photo_path = $request->file('photo')->store('driver_photos', 'public');
        }

        $driver->save();

        return redirect()->route('drivers.index')
            ->with('success', 'Driver berhasil diperbarui.');
    }

    public function destroy(Driver $driver)
    {
        if ($driver->photo_path) {
            Storage::disk('public')->delete($driver->photo_path);
        }

        $driver->delete();

        return redirect()->route('drivers.index')
            ->with('success', 'Driver berhasil dihapus.');
    }
}
