@extends('layouts.master')

@section('title', 'Prenotazioni Addetto')

@section('breadcrumb')

<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Home Addetto prenotazioni
            </li>
        </ol>
    </nav>
</div>

@endsection

@section('body')
PAGINA Addetto prenotazioni LISTA CON VOLI DELLA COMPAGNIA E PER OGNI VOLO VEDO TUTTI I NOMINATIVI<br>

@foreach ($prenotazioni as $prenotazione)
    <h1>id:{{$prenotazione->id}}</h1>
    <h2>id_prenotazione DEL VOLO:{{$prenotazione->volo_id}}</h2>
    <h3>id_cliente:{{$prenotazione->cliente_id}}</h3>
    {{ $prenotazione->passeggeri->count() }}
    @foreach ($prenotazione->passeggeri as $p)
        {{ $p->nome }} {{ $p->cognome}}<br>
    @endforeach
@endforeach

@endsection