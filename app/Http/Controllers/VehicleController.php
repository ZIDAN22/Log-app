<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::query();

        if ($search = $request->query('search')) {
            $query->where(function ($sub) use ($search) {
                $sub->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('license_plate', 'like', "%{$search}%")
                    ->orWhere('vehicle_type', 'like', "%{$search}%");
            });
        }

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        $vehicles = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type' => ['required', Rule::in(Vehicle::vehicleTypes())],
            'license_plate' => 'required|string|unique:vehicles,license_plate',
            'weight_capacity' => 'required|numeric|min:0',
            'volume_capacity' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'color' => 'required|string|max:100',
            'status' => ['required', Rule::in(Vehicle::statuses())],
            'photo' => 'nullable|image|max:2048',
        ]);

        $vehicleData = [
            'code' => Vehicle::generateCode(),
            'name' => $data['name'],
            'vehicle_type' => $data['vehicle_type'],
            'license_plate' => $data['license_plate'],
            'weight_capacity' => $data['weight_capacity'],
            'volume_capacity' => $data['volume_capacity'],
            'year' => $data['year'],
            'color' => $data['color'],
            'status' => $data['status'],
        ];

        if ($request->hasFile('photo')) {
            $vehicleData['photo_path'] = $request->file('photo')->store('vehicle_photos', 'public');
        }

        Vehicle::create($vehicleData);

        return redirect()->route('vehicles.index')
            ->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle)
    {
        return view('vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type' => ['required', Rule::in(Vehicle::vehicleTypes())],
            'license_plate' => ['required', 'string', Rule::unique('vehicles', 'license_plate')->ignore($vehicle->id)],
            'weight_capacity' => 'required|numeric|min:0',
            'volume_capacity' => 'required|numeric|min:0',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'color' => 'required|string|max:100',
            'status' => ['required', Rule::in(Vehicle::statuses())],
            'photo' => 'nullable|image|max:2048',
        ]);

        $vehicle->fill([
            'name' => $data['name'],
            'vehicle_type' => $data['vehicle_type'],
            'license_plate' => $data['license_plate'],
            'weight_capacity' => $data['weight_capacity'],
            'volume_capacity' => $data['volume_capacity'],
            'year' => $data['year'],
            'color' => $data['color'],
            'status' => $data['status'],
        ]);

        if ($request->hasFile('photo')) {
            if ($vehicle->photo_path) {
                Storage::disk('public')->delete($vehicle->photo_path);
            }
            $vehicle->photo_path = $request->file('photo')->store('vehicle_photos', 'public');
        }

        $vehicle->save();

        return redirect()->route('vehicles.index')
            ->with('success', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->photo_path) {
            Storage::disk('public')->delete($vehicle->photo_path);
        }

        $vehicle->delete();

        return redirect()->route('vehicles.index')
            ->with('success', 'Kendaraan berhasil dihapus.');
    }
}
