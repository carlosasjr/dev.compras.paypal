<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $title = 'Meu perfil';

        return view('store.user.profile', compact('title'));
    }

    public function logout()
    {
       Auth::logout();

       return redirect()->route('home');
    }

    public function profileUpdate(Request $request, User $user)
    {
       $this->validate($request, $user->rulesProfile);

       $user = $user->find(auth()->user()->id);
       $user->name = $request->get('name');
       $user->save();

       return redirect()->route('user.profile')
                        ->with('success', 'Perfil Atualizado com sucesso');
    }


    public function password()
    {
        $title = 'Atualizar senha';

        return view('store.user.password', compact('title'));
    }


    public function passwordUpdate(Request $request, User $user)
    {
        $this->validate($request, $user->rulesPassword);

        $user = $user->find(auth()->user()->id);

        $user->password = bcrypt($request->get('password'));

        $user->save();

        return redirect()->route('user.password')
                         ->with('success', 'Senha Atualizado com sucesso');
    }
}
