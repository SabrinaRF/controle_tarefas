@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Precisamos que valide seu email, para continuarmos!</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Reinviamos para o seu e-mail um link de validação.    
                        </div>
                    @endif

                    Antes de darmos continuidade, por favor valide seu e-mail por meio do link de verificação.<br>
                    Caso você não tenha recebido o link de verificação, clique no link a seguir,<br>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Clique aqui</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
