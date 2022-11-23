<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ContatoController extends Controller
{
    public Contato $contato;

    public function __construct(Contato $contato)
    {
        $this->contato = $contato;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $contatos = $this->contato->all();
        return Inertia::render('Contato', ['contatos' => $contatos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required',
            'cpf' =>  'required|formato_cpf',
        ];

        $feedback = [
            'required' => ':attribute não pode ser vazio!',
            'formato_cpf' => 'O campo não é um CPF válido!'
        ];
        $request->validate($regras, $feedback);

        $this->contato->create($request->all());

        return Redirect::route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contato  $contatos
     * @return \Illuminate\Http\Response
     */
    public function show(Contato $contatos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contato  $contatos
     * @return \Illuminate\Http\Response
     */
    public function edit(Contato $contatos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $regras = [
            'nome_edit' => 'required',
            'cpf_edit' =>  'required|formato_cpf',
        ];

        $feedback = [
            'cpf_edit.required' => 'O campo CPF não pode ser vazio!',
            'nome_edit.required' => 'O campo nome não pode ser vazio!',
            'cpf_edit.formato_cpf' => 'O campo CPF não possui o formato válido de CPF.'
        ];
        $request->validate($regras, $feedback);

        $contato = Contato::find($id);
        $contato->nome  = $request->nome_edit;
        $contato->cpf = $request->cpf_edit;
        $contato->email = $request->email;
        $contato->telefone = $request->telefone;
        $contato->principal = $request->principal;
        $contato->save();

        return Redirect::route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $contato = $this->contato->find($id);

        $contato->delete();

        return Redirect::route('home');
    }
}
