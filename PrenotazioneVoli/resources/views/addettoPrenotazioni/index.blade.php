@extends('layouts.master')

@section('title')
{{trans("messages.addetto_prenotazioni")}}
@endsection

@section('breadcrumb')

<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans("messages.listaVoliConPrenotazioni")}}
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('body')
<div class="container mt-3">
    <div class="form-group row">
        <label for="searchInput" class="col-sm-3 col-form-label">{{trans("messages.filtraPerNumeroVolo")}}:</label>
        <div class="col-sm-9">
            <input type="text" id="searchInput" class="form-control" placeholder="{{trans("messages.inserisciNVolo")}}">
        </div>
    </div>
    <div id="accordion">
        @foreach ($voli as $volo)
                <div class="card mb-3 flight-card">
                    <div class="card-header" id="heading{{$loop->index}}">
                        <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapse{{$loop->index}}" aria-expanded="false"
                                aria-controls="collapse{{$loop->index}}">
                                {{trans('messages.numero_volo')}}: {{$volo->numeroVolo}}
                            </button>
                        </h5>
                    </div>
                    <div id="collapse{{$loop->index}}" class="collapse" aria-labelledby="heading{{$loop->index}}"
                        data-parent="#accordion">
                        <div class="card-body">
                            <p><strong>{{trans('messages.numero_volo')}}:</strong> {{$volo->numeroVolo}}</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>{{trans("messages.aeroportoP")}}:</strong> {{ $volo->aereoportoPartenza->city }}
                                        ({{$volo->aereoportoPartenza->codice_iata}})</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>{{trans("messages.aeroportoA")}}:</strong> {{$volo->aereoportoArrivo->city}}
                                        ({{$volo->aereoportoArrivo->codice_iata}})</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>{{trans("messages.oraPartenza")}}:</strong>
                                        {{ \Carbon\Carbon::parse($volo->orarioPartenza)->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>{{trans("messages.oraArrivo")}}:</strong>
                                        {{ \Carbon\Carbon::parse($volo->orarioArrivo)->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                            <p><strong>{{trans("messages.aereo_modello")}}:</strong> {{$volo->aereo->nomeModello}}</p>
                            <p><strong>{{trans("messages.postiTotali")}}:</strong> {{$volo->aereo->capacita}}</p>
                            <p><strong>{{trans("messages.postiOccupati")}}:</strong>
                                {{ $volo->prenotazioni->reduce(function ($carry, $prenotazione) {
                return $carry + $prenotazione->passeggeri->count();
            }, 0) }}
                            </p>
                            <ul>
                                @foreach ($volo->prenotazioni->flatMap->passeggeri->sortBy(['cognome', 'nome']) as $passeggero)
                                    <li>{{$passeggero->cognome}} {{$passeggero->nome}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
</div>


<script>
    $(document).ready(function () {
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();

            $(".flight-card").each(function () {
                var flightNumber = $(this).find(".btn-link").text().toLowerCase();
                if (flightNumber.indexOf(value) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
@endsection