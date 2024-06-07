@extends('layouts.master')

@section('title', 'Creazione Account Addetto')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Creazione Account Addetto
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('body')
<div class="container mt-3 mb-5">

    <div class="row">
        <div class="col-md-12">
            @if(isset($addetti->id))
                <form class="form-horizontal" name="addetti" method="post"
                    action="{{ route('addetti.update', ['addetti' => $addetti->id]) }}">
                    @method('PUT')
            @else
                <form class="form-horizontal" name="addetti" method="post" action="{{ route('addetti.store') }}">
            @endif
                    @csrf
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Nome</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($addetti->id))
                                <input class="form-control" type="text" name="nome" placeholder="Nome"
                                    value="{{ $addetti->nome }}" />
                            @else
                                <input class="form-control" type="text" name="nome" placeholder="Nome" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Cognome</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($addetti->id))
                                <input class="form-control" type="text" name="cognome" placeholder="Cognome"
                                    value="{{ $addetti->cognome }}" />
                            @else
                                <input class="form-control" type="text" name="cognome" placeholder="Cognome" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Data Di Nascita</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($addetti->id))
                                <input class="form-control" type="date" name="data" placeholder="Data Di Nascita"
                                    value="{{ $addetti->dataNascita }}" />
                            @else
                                <input class="form-control" type="date" name="data" placeholder="Data Di Nascita" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Luogo di Nascita</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($addetti->id))
                                <input class="form-control" type="text" name="luogo" placeholder="Luogo di Nascita"
                                    value="{{ $addetti->luogoNascita }}" />
                            @else
                                <input class="form-control" type="text" name="luogo" placeholder="Luogo di Nascita" />
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Compagnia</label>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" name="compagnia">
                                @foreach($companies as $comp)
                                    @if((isset($addetti->id)) && ($addetti->compagnia_id == $comp->id))
                                        <option value="{{ $comp->id }}" selected="selected">
                                            {{ $comp->nome }}
                                        </option>
                                    @else
                                        <option value="{{ $comp->id }}">
                                            {{ $comp->nome }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>


                    @php
                        $ruoli = ["prenotazioni", "inserimento"];

                    @endphp

                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Ruolo</label>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" name="ruolo">
                                @foreach($ruoli as $ruolo)
                                    @if((isset($addetti->id)) && ($addetti->ruolo == $ruolo))
                                        <option value="{{ $ruolo }}" selected="selected">
                                            {{ strtoupper($ruolo) }}
                                        </option>
                                    @else
                                        <option value="{{ $ruolo }}">
                                            {{ strtoupper($ruolo) }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">E-Mail</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($addetti->id))
                                <input class="form-control" type="text" name="email" placeholder="E-Mail"
                                    value="{{ $addetti->email }}" />
                            @else
                                <input class="form-control" type="text" name="email" placeholder="E-Mail" />
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Password</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($addetti->id))
                                <input class="form-control" type="password" name="password" placeholder="Password"
                                    value="{{ $addetti->password }}" />
                            @else
                                <input class="form-control" type="password" name="password" placeholder="Password" />
                            @endif
                        </div>
                    </div>




                    <div class="form-group row mb-3">
                        <div class="col-md-10 offset-md-2">
                            <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i>
                                Salva</label>
                            <input id="mySubmit" class="d-none" type="submit" value="Save">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-10 offset-md-2">
                            <a class="btn btn-secondary w-100" href="{{ url()->previous() }}"><i
                                    class="bi bi-box-arrow-left"></i> Cancella</a>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection