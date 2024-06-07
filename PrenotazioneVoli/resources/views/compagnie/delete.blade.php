@extends('layouts.master')

@section('title', 'Elimina Compagnia')

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
                Elimina Compagnia
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('body')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-6 text-center mt-5 mb-5">
            <h3>Sei sicuro di voler eliminare la compagnia {{$compagnia->nome}}?</h3>
            <p>Una volta eseguita, questa operazione non può essere cambiata.</p>

            <form name="compagnia" method="post"
                action="{{ route('compagnie.destroy', ['compagnie' => $compagnia->id]) }}">
                @method('DELETE')
                @csrf
                <a href="{{route('compagnie.index')}}" class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i>
                    Annulla</a>
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Elimina</button>

            </form>
        </div>
    </div>
</div>

@endsection