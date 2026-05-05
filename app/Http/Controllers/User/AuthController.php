<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('layouts.user.login');
    }

    public function showRegister()
    {
        return view('layouts.user.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:members,email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $member = Member::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'joined_date' => now()->toDateString(),
            'password' => Hash::make($data['password']),
        ]);

        session(['member_id' => $member->id]);

        return redirect()->route('user.home');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $member = Member::where('email', $data['email'])->first();

        if (! $member || ! Hash::check($data['password'], $member->password)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->onlyInput('email');
        }

        session(['member_id' => $member->id]);

        return redirect()->route('user.home');
    }

    public function logout()
    {
        session()->forget('member_id');

        return redirect()->route('login');
    }
}