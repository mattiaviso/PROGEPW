@extends('layouts.master')

@section('title')
{{trans("messages.dettCompagnia")}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{route('compagnie.index')}}">{{trans("messages.lista_compagnie")}}</a>
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-left shadow-sm" style="border-radius: 10px; border: 3px solid #827E7E;">
                <div class="card-body" style="background-color: #f8f9fa; padding: 20px;">
                    <p class="mb-2"><strong>{{trans("messages.nomeCompagnia")}}:</strong> {{ $compagnia->nome}}</p>
                    <p class="mb-2"><strong>{{trans("messages.sede_centrale")}}:</strong> {{ $compagnia->sede}}</p>
                    <p class="mb-2"><strong>{{trans("messages.nazioneRegistrazione")}}:</strong>
                        {{ $compagnia->country}}</p>
                    <p class="mb-2"><strong>{{trans("messages.annoFondazione")}}:</strong>
                        {{ $compagnia->anno_fondazione}}</p>
                    <p class="mb-0"><strong>{{trans("messages.voliInseriti")}}:</strong> {{$compagnia->voli->count()}}
                    </p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route("compagnie.index") }}" class="btn btn-secondary">
                        <i class="bi bi-box-arrow-left"></i> {{trans("messages.indietro")}}
                    </a>

                    <a href="{{ route("compagnie.edit", $compagnia->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square"></i> {{trans("messages.modifica")}}
                    </a>
                    @if($compagnia->voli->count() > 0)
                        <button class="btn btn-secondary" disabled>
                            <i class="bi bi-ban"></i> {{trans("messages.elimina")}}
                        </button>
                    @else
                        <a href="{{route("compagnie.destroy.confirm", $compagnia->id)}}" class="btn btn-danger">
                            <i class="bi bi-trash"></i> {{trans("messages.elimina")}}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection