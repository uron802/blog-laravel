<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $users = User::orderBy('email', 'asc')->simplePaginate(10);

        return view('user.list', [
            'users' => $users,
        ]);
    }

    public function activate(User $user)
    {
        if ($user != null) {
            $user->active = 1;
            $user->save();
        }

        return redirect()->route('user.list');
    }
}
