@extends('layouts.master')

@section('title')
@if(isset($compagnia))
    Modifica Compagnia
@else
    Aggiungi Compagnia
@endif

@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{route('compagnie.index')}}">Lista Compagnie</a>
            </li>

            @if(isset($compagnia))
                <li class="breadcrumb-item active" aria-current="page">
                    Modifica Compagnia</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">
                    Aggiungi Compagnia</li>
            @endif
        </ol>
    </nav>
</div>
@endsection


@section('body')
<div class="container mt-3 mb-5">

    <div class="row">
        <div class="col-md-12">
            @if(isset($compagnia->id))
                <form class="form-horizontal" name="compagnia" method="post"
                    action="{{ route('compagnie.update', ['compagnie' => $compagnia->id]) }}">
                    @method('PUT')
            @else
                <form class="form-horizontal" name="compagnia" method="post" action="{{ route('compagnie.store') }}">
            @endif
                    @csrf
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Nome Compagnia</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($compagnia->id))
                                <input class="form-control" type="text" name="nome" placeholder="Nome Compagnia"
                                    value="{{ $compagnia->nome }}" />
                            @else
                                <input class="form-control" type="text" name="nome" placeholder="Nome Compagnia" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Sede Centrale</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($compagnia->id))
                                <input class="form-control" type="text" name="city" placeholder="Sede Centrale"
                                    value="{{ $compagnia->sede }}" />
                            @else
                                <input class="form-control" type="text" name="city" placeholder="Sede Centrale" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Nazione di Registrazione</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($compagnia->id))
                                <input class="form-control" type="text" name="country"
                                    placeholder="Nazione di Registrazione<" value="{{ $compagnia->country }}" />
                            @else
                                <input class="form-control" type="text" name="country"
                                    placeholder="Nazione di Registrazione" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Anno di Fondazione</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($compagnia->id))
                                <input class="form-control" type="text" name="anno" placeholder="Anno di Fondazione"
                                    value="{{ $compagnia->anno_fondazione }}" />
                            @else
                                <input class="form-control" type="text" name="anno" placeholder="Anno di Fondazione" />
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