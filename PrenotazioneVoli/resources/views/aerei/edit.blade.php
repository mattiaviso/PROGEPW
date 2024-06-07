@extends('layouts.master')

@section('title', 'Aggiungi Aereo')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{route('aerei.index')}}">Lista Aerei</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Aggiungi Aereo
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('body')
<!-- Fai form per aggiungwere aereo con nome e capacita -->
<div class="container mt-4">
    <div class="col-md-12">
        <form action="{{route('aerei.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="nomeModello" class="form-label">Nome Modello</label>
                <input type="text" class="form-control" id="nome" name="nome">
            </div>
            <div class="mb-3">
                <label for="capacita" class="form-label">Capacità</label>
                <input type="number" class="form-control" id="posti" name="posti">
            </div>
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
    </div>
</div>


@endsection