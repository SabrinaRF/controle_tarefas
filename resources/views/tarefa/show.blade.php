@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $tarefa->tarefa}}</div>
                <div class="card-body">
                <fieldset disabled>
                    <div class="form-group">
                        <label for="data_limite_conclusao">Data limite de Conclusão</label>
                        <input type="date" class="form-control"  value="{{$tarefa->data_limite_conclusao}}" >
                    </div>
                    <a href="{{url()->previous()}}" class="btn btn-primary">Voltar</a>
                </fieldset >
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
