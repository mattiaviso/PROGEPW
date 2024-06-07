@extends('layouts.master')

@section('title', 'Account')

@section('body')


<div class="card-body container mt-3">
    <div class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" value="{{ $cliente->nome }}" readonly>
    </div>
    <div class="form-group">
        <label for="cognome">Cognome</label>
        <input type="text" class="form-control" id="cognome" name="cognome" value="{{ $cliente->cognome }}" readonly>
    </div>
    <div class="form-group">
        <label for="dataNascita">Data di Nascita</label>
        <input type="date" class="form-control" id="dataNascita" name="dataNascita" value="{{ $cliente->dataNascita }}"
            readonly>
    </div>
    <div class="form-group">
        <label for="luogoNascita">Luogo di Nascita</label>
        <input type="text" class="form-control" id="luogoNascita" name="luogoNascita"
            value="{{ $cliente->luogoNascita }}" readonly>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $cliente->email }}" readonly>
    </div>
    @if (isset($cliente->compagnia))
        <div class="form-group">
            <label for="nomeCompagnia">Nome Compagnia</label>
            <input type="text" class="form-control" id="nomeCompagnia" name="nomeCompagnia"
                value="{{ $cliente->compagnia->nome }}" readonly>
        </div>
    @endif

</div>


@endsection