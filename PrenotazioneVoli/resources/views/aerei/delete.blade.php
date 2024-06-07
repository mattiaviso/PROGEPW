@extends('layouts.master')

@section('title', 'Cancella Modello Aereo')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a href="{{route('aerei.index')}}">Modelli Aerei</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Cancella Modello Aereo
            </li>
        </ol>
    </nav>
</div>

@endsection

@section('body')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-6 text-center mt-5 mb-5">
            <h3>Sei sicuro di voler eliminare {{$aereo->nomeModello}}?</h3>
            <p>Una volta eseguita, questa operazione non può essere cambiata.</p>
            <form name="airport" method="post" action="{{ route('aerei.destroy', ['aerei' => $aereo->id]) }}">
                @method('DELETE')
                @csrf
                <a href="{{route('aerei.index')}}" class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i>
                    Annulla</a>
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Elimina</button>
            </form>

        </div>
    </div>
</div>
@endsection