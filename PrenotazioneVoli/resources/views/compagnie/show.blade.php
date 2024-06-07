@extends('layouts.master')

@section('title', 'Dettagli Compagnia')

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
            <li class="breadcrumb-item active" aria-current="page">
                {{$compagnia->nome}}
            </li>
        </ol>
    </nav>
</div>

@endsection

@section('body')
<style>
    .logo-img {
        max-width: 100px;
        height: auto;
    }
</style>
<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-md-6 text-left my-4" style="background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
            <p><strong>Nome:</strong> {{ $compagnia->nome}}</p>
            <p><strong>Sede Centrale:</strong> {{ $compagnia->sede}}</p>
            <p><strong>Nazione di Registrazione:</strong> {{ $compagnia->country}}</p>
            <p><strong>Anno di Fondazione:</strong> {{ $compagnia->anno_fondazione}}</p>
        </div>
    </div>

    <div class="form-group row mb-3">
        <div class="col-md-12 offset-md-0">
            <a href="{{ route("compagnie.index") }}" class="btn btn-outline-primary btn-block btn-lg"><i
                    class="bi bi-box-arrow-left"></i>
                Indietro</a>
        </div>
    </div>

    <div class="form-group row mb-3">
        <div class="col-md-12 offset-md-0">
            <a href="{{ route("compagnie.edit", $compagnia->id) }}" class="btn btn-warning btn-block btn-lg"><i
                    class="bi bi-pencil-square"></i> Modifica</a>
        </div>
    </div>
    <div class="form-group row mb-3">
        <div class="col-md-12 offset-md-0">

            @if($compagnia->voli->count() > 0)
                <a class="btn btn-secondary btn-block btn-lg" disabled="disabled"><i class="bi bi-ban"></i> Elimina</a>
            @else
                <a class="btn btn-danger btn-block btn-lg" href="{{route("compagnie.destroy.confirm", $compagnia->id)}}"><i
                        class="bi bi-trash"></i> Elimina</a>

            @endif
        </div>
    </div>

</div>


@endsection