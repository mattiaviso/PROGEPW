@extends('layouts.master')

@section('title', 'Inserimento Nuovi Voli')

@section('breadcrumb')

<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans('messages.lista_voli')}} {{ $voli->first()->compagnia->nome }}
            </li>
        </ol>
    </nav>
</div>

@endsection


@section('body')
<div class="container mt-4 ">
    <div class="col-xs-6 d-flex justify-content-end">
        <a href="{{ route("voli.create") }}" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i>
            {{trans('messages.aggiungiVolo')}}</a>
    </div>
</div>


<div class="container mt-4">
    <div class="col-md-12">
        <table class="table table-hover">
            <col width='16%'>
            <col width='10%'>
            <col width='10%'>
            <col width='15%'>
            <col width='16%'>
            <col width='17%'>
            <col width='16%'>
            <thead>
                <tr>
                    <th>Codice Volo</th>
                    <th>Partenza</th>
                    <th>Arrivo</th>
                    <th>Data</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($voli as $volo)
                    <tr>
                        <td>
                            <h6>{{$volo->numeroVolo}}</h6>
                        </td>
                        <td>
                            <h6>{{$volo->aereoportoPartenza->codice_iata}}</h6>
                        </td>
                        <td>
                            <h6>{{$volo->aereoportoArrivo->codice_iata}}</h6>
                        </td>
                        <td>
                            <h6>{{ \Carbon\Carbon::parse($volo->orarioPartenza)->format('d/m/Y') }}</h6>
                        </td>
                        <td>
                            <a href="{{route('voli.show', $volo->id)}}" class="btn btn-info mr-2"><i
                                    class="bi bi-search"></i> Dettagli</a>
                        </td>
                        <td>
                            <a href="{{route("voli.edit", $volo->id)}}" class="btn btn-warning mr-2"><i
                                    class="bi bi-pencil-square"></i> Modifica</a>
                        </td>
                        <td>
                            @if($volo->prenotazioni->count() > 0)
                                <a class="btn btn-secondary" disabled="disabled"><i class="bi bi-ban"></i> Elimina</a>
                            @else
                                <a class="btn btn-danger" href="{{route('voli.destroy.confirm', $volo->id)}}"><i
                                        class="bi bi-trash"></i>
                                    Elimina</a>
                            @endif

                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection