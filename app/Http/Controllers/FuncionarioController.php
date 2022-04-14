<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Funcionarios;

class FuncionarioController extends Controller
{
    function index()
    {
        return view('manage/cadastrofuncionario');
    }
    function cadastrarFunc(Request $request)
    {
        $this->validate($request, [
            'cpf'  => 'required|min:14',
            'nome'  => 'required|min:5'
            ]);

        $nome = $request->get('nome');
        $cpf_raw = $request->get('cpf');//only('cpf')[0]

        $cpf = preg_replace('/[^0-9]/', '', $cpf_raw);
        try{
        $funcionario = Funcionarios::create(['nome'=>$nome,'cpf' =>$cpf]);
        return back()->with('success', "CPF $cpf_raw cadastrado com sucesso!");
        }
        catch(ModelNotFoundException $e){
            return back()->with('error', 'CPF informado já existe em nossos registros.');
        }
    }
}
