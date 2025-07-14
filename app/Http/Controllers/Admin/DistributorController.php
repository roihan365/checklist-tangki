<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::where('name', 'admin-distributor')->first();
        $adminDistributors = $role->users()->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.admin.distributor-data.index', compact('adminDistributors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.distributor-data.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telephone' => 'required|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('profile-photos', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['status_registrasi'] = 'Non-Berhasil';

        $user = User::create($validated);
        $user->assignRole('admin-distributor');

        return redirect()->route('admin.distributor.index')
            ->with('success', 'Admin distributor berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $distributor)
    {
        return view('pages.admin.distributor-data.show', compact('distributor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $distributor)
    {
        return view('pages.admin.distributor-data.edit', compact('distributor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $distributor)
    {

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $distributor->id,
            'password' => 'nullable|string|min:8|confirmed',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telephone' => 'required|string|max:15',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_registrasi' => 'required|in:Berhasil,Non-Berhasil',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($distributor->photo) {
                Storage::disk('public')->delete($distributor->photo);
            }
            $validated['photo'] = $request->file('photo')->store('profile-photos', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $distributor->update($validated);

        return redirect()->route('admin.distributor.index')
            ->with('success', 'Profil admin distributor berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $distributor)
    {
        // Delete photo if exists
        if ($distributor->photo) {
            Storage::disk('public')->delete($distributor->photo);
        }

        $distributor->delete();

    return redirect()->route('admin.distributor.index')
            ->with('success', 'Admin distributor berhasil dihapus');
    }
}
