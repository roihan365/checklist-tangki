<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'jenis_kelamin' => ['required', 'string', 'in:L,P'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'string', 'max:255'],
            'no_telephone' => ['required', 'string', 'max:15'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $request->merge([
            'status_registrasi' => 'Berhasil',
        ]);
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'no_telephone' => $request->no_telephone,
            'photo' => $request->file('photo') ? $request->file('photo')->store('photos', 'public') : null,
            'status_registrasi' => $request->status_registrasi,
        ])->assignRole('admin-distributor'); // Assign default role 'admin-distributor' if needed

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('distributor.checklist-schedule.index', absolute: false));
    }
}
