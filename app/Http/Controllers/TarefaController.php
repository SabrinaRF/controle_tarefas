<?php

namespace App\Http\Controllers;

use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $tarefas= Tarefa::where('user_id',$user_id)->paginate(10);

        return view('tarefa.index',['tarefas'=>$tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all('tarefa','data_limite_conclusao');
        $dados['user_id']= auth()->user()->id;

        $tarefa =Tarefa::create($dados);

        $destinatario= auth()->user()->email; //pega o email do usuario logado
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));//envia um email para o destinatário com os dados da nova
        //redireciona para o index da tela de listagem das tarefa
        return redirect()->route('tarefa.show',['tarefa'=>$tarefa->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        return view( 'tarefa.show' , ['tarefa'=>$tarefa] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        $user_id= auth()->user()->id;
        if($tarefa->user_id ==$user_id){
            return view('tarefa.edit',['tarefa'=>$tarefa]);
        }else{
            return view('acesso_negado');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $user_id= auth()->user()->id;
        if ($tarefa->user_id ==$user_id){

            $tarefa->update($request->all());    
            return redirect()->route('tarefa.show', ['tarefa'=>$tarefa] );
        }else{
            return view('acesso_negado');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        if (!$tarefa->user_id == auth()->user()->id) {
            return view('acesso_negado');
        }

        $tarefa->delete();
        return redirect()->route('tarefa.index');
    }
}
