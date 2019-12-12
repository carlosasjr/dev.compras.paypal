@extends('store.templates.master')

@section('content')
    <h1 class="title">Atualizar senha</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-warning">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif


    <form action="{{ route('update.password') }}" class="form" method="post">
        @csrf
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Senha" class="form-control" required>
        </div>


        <div class="form-group">
            <label for="password_confirmation">Confirmar Senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Senha" class="form-control" required >
        </div>


        <input type="submit" class="btn btn-primary" value="Atualizar Senha">
    </form>
@endsection


