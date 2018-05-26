<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

/**
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function index()
    {
        $users = User::orderby('name')->get();

        return view('users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function show($uuid)
    {
        $user = User::uuid($uuid);
        $this->authorize('view', $user);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    } /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $user = User::uuid($uuid);
        $this->authorize('delete', $user);

        if (!$user->delete()) {
            return response()->redirectToRoute('users.index')
                ->with('error', 'Erro ao excluir!');
        }

        return response()->redirectToRoute('users.index')
            ->with('status', 'Usuário excluído com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function block(User $user)
    {
        $this->authorize('setBlock', $user);

        return $user->block()
            ? back()->with('status', 'Usuário bloqueado')
            : back()->with('error', 'Erro ao bloquear usuário');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function unblock(User $user)
    {
        $this->authorize('setBlock', $user);

        return $user->unblock()
            ? back()->with('status', 'Usuário desbloqueado')
            : back()->with('error', 'Erro ao desbloquear usuário');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function setAsAdmin(User $user)
    {
        $this->authorize('setType', $user);

        return $user->setAsAdmin()
            ? back()->with('status', 'Tipo do usuário modificado')
            : back()->with('error', 'Erro ao modificar o tipo do usuário');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function setAsUser(User $user)
    {
        $this->authorize('setType', $user);

        if ($user->role == 'admin' && User::where('role', 'admin')->get()->count() == 1) {
            return back()->with('error', 'Não é possível tornar o último administrador usuário.');
        }

        return $user->setAsUser()
            ? back()->with('status', 'Tipo do usuário modificado')
            : back()->with('error', 'Erro ao modificar o tipo do usuário');
    }
}
