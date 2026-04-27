<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserController extends Controller
{
    // tampil data user
    public function index()
    {
        $dtuser = User::orderBy('level','asc')->paginate(10);
        return view('user.data_user', compact('dtuser'));
    }

    // simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'alamat'   => 'required|string',
            'level'    => 'required|string',
            'email'    => 'required|string',
            'password' => 'required|min:5'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'alamat'   => $request->alamat,
            'level'    => $request->level,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('data-user')->with('success', 'User berhasil ditambahkan!');
    }

    // update user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'alamat'=> 'required|string',
            'email' => 'required|string',
            'level' => 'required|string',
        ]);

        $user = User::findOrFail($id);
        $user->name  = $request->name;
        $user->email  = $request->email;
        $user->alamat = $request->alamat;
        $user->level = $request->level;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('data-user')->with('success', 'User berhasil diperbarui!');
    }

    // hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('data-user')->with('success', 'User berhasil dihapus!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui');
    }
}
