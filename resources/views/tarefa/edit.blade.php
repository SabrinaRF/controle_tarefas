@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Tarefa</div>

                <div class="card-body">

                    <form method="post" action="{{ route('tarefa.update', ['tarefa'=>$tarefa->id])}}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="tarefa">Tarefa</label>
                            <input type="text" class="form-control" id="tarefa" name="tarefa" value="{{ $tarefa->tarefa}}">
                        </div>
                        <div class="form-group">
                            <label for="data_limite_conclusao">Data limite de Conclusão</label>
                            <input type="date" class="form-control" id="data_limite_conclusao" name="data_limite_conclusao" value="{{ $tarefa->data_limite_conclusao}}" >
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
