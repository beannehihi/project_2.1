<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function create()
    {
        return view('pages.user.profile');
    }

    public function update()
    {

        $user = request()->user();
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'name' => 'required',
            'date' => 'required|',
            'phone' => 'required|max:10',
            'about' => 'required:max:150',
            'location' => 'required'
        ]);

        auth()->user()->update($attributes);
        return back()->with('success', 'Cập nhật thành công');
        // Profile successfully updated.
    }
}
