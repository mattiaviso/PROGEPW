@extends('layouts.master')

@section('title', 'Elimina Utenza')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{url()->previous()}}">Lista Utenze</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Elimina Utenza
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('body')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-6 text-center mt-5 mb-5">
            <h3>Sei sicuro di voler eliminare {{$utente->nome}} {{$utente->cognome}}?</h3>
            <p>Una volta eseguita, questa operazione non può essere cambiata.</p>

            <form name="airport" method="post" action="{{ route('addetti.destroy', ['addetti' => $utente->id]) }}">
                @method('DELETE')
                @csrf
                <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i>
                    Annulla</a>
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Elimina</button>

            </form>
        </div>
    </div>
</div>
@endsection