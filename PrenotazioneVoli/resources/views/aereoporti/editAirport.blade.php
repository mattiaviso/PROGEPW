@extends('layouts.master')


@section('title', 'Modifica Aeroporto')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{route('aereoporti.index')}}">Aeroporti</a>
            </li>
            @if(isset($airport->id))
                <li class="breadcrumb-item active" aria-current="page">Modifica Aeroporto</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">Aggiungi Aeroporto</li>
            @endif
        </ol>
    </nav>
</div>

@endsection

@section('body')
<div class="container mt-3 mb-5">

    <div class="row">
        <div class="col-md-12">
            @if(isset($airport->id))
                <form class="form-horizontal" name="airport" method="post"
                    action="{{ route('aereoporti.update', ['aereoporti' => $airport->id]) }}">
                    @method('PUT')
            @else
                <form class="form-horizontal" name="airport" method="post" action="{{ route('aereoporti.store') }}">
            @endif
                    @csrf
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Nome Aeroporto</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="nome" placeholder="Nome Aeroporto"
                                    value="{{ $airport->nome }}" />
                            @else
                                <input class="form-control" type="text" name="nome" placeholder="Nome Aeroporto" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Città</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="city" placeholder="Città"
                                    value="{{ $airport->city }}" />
                            @else
                                <input class="form-control" type="text" name="city" placeholder="Città" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Nazione</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="country" placeholder="Nazione"
                                    value="{{ $airport->country }}" />
                            @else
                                <input class="form-control" type="text" name="country" placeholder="Nazione" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Codice IATA</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="code" placeholder="Codice IATA"
                                    value="{{ $airport->codice_iata }}" />
                            @else
                                <input class="form-control" type="text" name="code" placeholder="Codice IATA" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Latitudine</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="lat" placeholder="Latitudine"
                                    value="{{ $airport->lat }}" />
                            @else
                                <input class="form-control" type="text" name="lat" placeholder="Latitudine" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Longitudine</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="lon" placeholder="Longitudine"
                                    value="{{ $airport->lon }}" />
                            @else
                                <input class="form-control" type="text" name="lon" placeholder="Longitudine" />
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