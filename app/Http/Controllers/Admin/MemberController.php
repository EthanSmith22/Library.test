<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $members = Member::withCount('borrowRecords')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('layouts.admin.members.members', compact('members'));
    }

    public function create()
    {
        return view('layouts.admin.members.members-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:members,email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'joined_date' => ['required', 'date'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $data['password'] = Hash::make($data['password']);

        Member::create($data);

        return redirect()->route('admin.members')->with('success', 'Member created successfully.');
    }

    public function edit(Member $member)
    {
        return view('layouts.admin.members.members-edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:members,email,' . $member->id],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'joined_date' => ['required', 'date'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $member->update($data);

        return redirect()->route('admin.members')->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('admin.members')->with('success', 'Member deleted successfully.');
    }
}