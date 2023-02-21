<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomPasswordController extends Controller
{
    public function changePassword()
    {
        return view('profile.change-password');
    }

    public function saveNewPassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        $user->password=password_hash($validatedData['password'],PASSWORD_DEFAULT);
        $user->save();

        return redirect(route('home'))->with('msg-success','Senha alterada com sucesso!');

    }
}
