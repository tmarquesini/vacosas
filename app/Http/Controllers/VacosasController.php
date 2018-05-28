<?php

namespace App\Http\Controllers;

use App\Vacosa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class VacosasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacosas = Vacosa::abertas()->get();

        return view('vacosas.index', compact('vacosas'));
    }

    public function fechadas()
    {
        $vacosas = Vacosa::fechadas()->get();
        return view('vacosas.index', compact('vacosas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Vacosa::class);

        return view('vacosas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Vacosa::class);

        $this->validator($request->all())->validate();

        $data = [
            'organizador_id' => Auth::user()->id,
            'nome' => $request->nome,
            'valor' => $request->valor,
            'url' => $request->url,
            'descricao' => $request->descricao,
        ];

        $vacosa = Vacosa::create($data);

        if (!$vacosa) {
            return back()->with('error', 'Erro ao tentar iniciar vacosa!');
        }

        $vacosa->contribuicoes()->create([
            'participante_id' => $vacosa->organizador->id,
            'valor' => $request->contribuicao,
        ]);

        return response()->redirectToRoute('vacosas.index')->with('status', 'Vacosa iniciada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  Vacosa $vacosa
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($uuid)
    {

        $vacosa = Vacosa::uuid($uuid);
        $this->authorize('view', $vacosa);

        return view('vacosas.show', compact('vacosa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Vacosa $vacosa
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Vacosa $vacosa)
    {
        $this->authorize('update', $vacosa);

        return view('vacosas.edit', compact('vacosa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Vacosa $vacosa
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Vacosa $vacosa)
    {
        $this->authorize('update', $vacosa);

        $vacosa->fill($request->all());

        if (!$vacosa->save()) {
            return response()->redirectToRoute('vacosas.show', $vacosa)
                ->with('error', 'Erro ao editar vacosa!');
        }

        return response()->redirectToRoute('vacosas.show', $vacosa)
            ->with('status', 'Vacosa editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Vacosa $vacosa
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Vacosa $vacosa)
    {
        $this->authorize('delete', $vacosa);

        if (!$vacosa->delete()) {
            return response()->redirectToRoute('vacosas.index')
                ->with('error', 'Erro ao excluir vacosa!');
        }

        return response()->redirectToRoute('vacosas.index')
            ->with('status', 'Vacosa excluída com sucesso!');
    }

    /**
     * Get a validator for an incoming request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'contribuicao' => 'required|numeric|min:20',
            'url' => 'required|url',
        ]);
    }
}
