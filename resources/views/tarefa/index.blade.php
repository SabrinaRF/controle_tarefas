@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tarefas</div>

                <div class="card-body">
                <a href="{{ route('tarefa.create')}}" class="mb-5"> Adicionar tarefa</a>
                   <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tarefa</th>
                                <th scope="col">Data Limite</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tarefas as $key => $tarefa)
                            <tr>
                                <th scope="row">{{ $tarefa['id']}}</th>
                                <td>{{ $tarefa['tarefa']}}</td>
                                <td>{{ date('d/m/Y', strtotime($tarefa['data_limite_conclusao'])) }}</td>
                                <td><a href="{{route('tarefa.edit',$tarefa->id)}}" class="btn btn-primary">Editar</a></td>
                                <td>
                                    <form id="form_{{$tarefa['id']}}" method="post" action="{{route('tarefa.destroy', $tarefa->id)}}">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    <a href="#" class="btn btn-primary" onclick="document.getElementById('form_{{$tarefa['id']}}').submit()">Excluir</a> 
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination"><!--terminar depois-->
                            <li class="page-item"><a class="page-link" href="{{$tarefas->previousPageUrl()}}">Voltar</a></li>
                            @for ($i=1; $i <= $tarefas->lastPage();  $i++)
                                <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : ''}}">
                                    <a class="page-link" href="{{$tarefas->url($i)}}">{{$i}}</a>
                                </li>
                            @endfor
                            <li class="page-item"><a class="page-link" href="{{$tarefas->nextPageUrl()}}">Avançar</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
