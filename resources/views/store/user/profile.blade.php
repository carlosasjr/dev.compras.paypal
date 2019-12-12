@extends('store.templates.master')

@section('content')
    <h1 class="title">Meu Perfil</h1>

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

    <form action="{{ route('update.profile') }}" class="form" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" placeholder="Meu Nome" class="form-control"
                   value="{{ auth()->user()->name }}">
        </div>

        <div class="form-group">
            <label for="name">E-mail</label>
            <input type="text" id="email" name="email" placeholder="Meu e-mail" disabled="disabled" class="form-control"
                   value="{{ auth()->user()->email }}">
        </div>

        <input type="submit" class="btn btn-primary" value="Salvar">
    </form>
@endsection


