<?php

namespace App\Http\Controllers;

use App\Contribuicao;
use App\User;
use App\Vacosa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ContribuicoesController
 * @package App\Http\Controllers
 */
class ContribuicoesController extends Controller
{
    /**
     * @param Vacosa $vacosa
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Vacosa $vacosa)
    {
        $users = User::orderBy('name')->get();

        return view('contribuicoes.create', compact(['vacosa', 'users']));
    }

    /**
     * @param Request $request
     * @param Vacosa $vacosa
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Vacosa $vacosa)
    {
        // $this->validator($request->all())->validate();

        $data = [
            'vacosa_id' => $request->vacosa,
            'participante_id' => $request->participante,
            'valor' => $request->valor,
        ];

        if (! Contribuicao::create($data)) {
            return response()->redirectToRoute('vacosas.show', $vacosa->uuid)
                ->with('error', 'Erro ao tentar adicionar contribuição!');
        }

        return response()->redirectToRoute('vacosas.show', $vacosa->uuid)
            ->with('status', 'Contribuição adicionada com sucesso!');
    }

    /**
     * @param Vacosa $vacosa
     * @param Contribuicao $contribuicao
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmDestroy(Vacosa $vacosa, Contribuicao $contribuicao)
    {
        return view('contribuicoes.delete', compact(['vacosa', 'contribuicao']));
    }

    /**
     * @param Contribuicao $contribuicao
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Contribuicao $contribuicao)
    {
        if (! $contribuicao->delete()) {
            return response()->redirectToRoute('vacosas.show', $vacosa->uuid)
                ->with('error', 'Erro ao excluir contribuição!');
        }

        return response()->redirectToRoute('vacosas.show', $vacosa->uuid)
            ->with('status', 'Contribuição excluída com sucesso!');
    }

    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'vacosa_id' => 'required|exists:vacosa.id',
            'participante_id' => 'required|exists:user.id',
            'valor' => 'required|numeric|min:10',
        ]);
    }
}
