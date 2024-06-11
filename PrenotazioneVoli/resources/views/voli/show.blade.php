@extends('layouts.master')

@section('title', '{{trans("messages.dettagliVolo")}}')


@section('breadcrumb')
@if($_SESSION['ruolo'] == 'inserimento')
    @if((isset($_SESSION['logged'])) && $volo->compagnia->id == $compagniaUser)
        <div class="container mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item">
                        <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
                    </li>
                    @if((isset($_SESSION['logged'])) && ($_SESSION['logged']))
                        @if ($_SESSION['ruolo'] == 'inserimento')
                            <li class="breadcrumb-item">
                                <a href="{{route('addettoVoli')}}">{{trans('messages.lista_voli')}}</a>
                            </li>
                        @else
                            <li class="breadcrumb-item">
                                <a href="{{route('voli.index')}}">{{trans('messages.lista_voli')}}</a>
                            </li>
                        @endif
                    @endif

                    <li class="breadcrumb-item active" aria-current="page">
                        {{$volo->numeroVolo}}
                    </li>
                </ol>
            </nav>
        </div>
    @endif
@else
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-end">
                <li class="breadcrumb-item">
                    <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
                </li>
                @if((isset($_SESSION['logged'])) && ($_SESSION['logged']))
                    @if ($_SESSION['ruolo'] == 'inserimento')
                        <li class="breadcrumb-item">
                            <a href="{{route('addettoVoli')}}">{{trans('messages.lista_voli')}}</a>
                        </li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{route('voli.index')}}">{{trans('messages.lista_voli')}}</a>
                        </li>
                    @endif
                @endif
                <li class="breadcrumb-item active" aria-current="page">
                    {{$volo->numeroVolo}}
                </li>
            </ol>
        </nav>
    </div>
@endif
@endsection


@section('body')
@if(($compagniaUser == null) || (isset($_SESSION['logged'])) && $volo->compagnia->id == $compagniaUser)
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-md-5 text-left mr-5 my-4"
                style="background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
                <p><strong>{{trans('messages.numero_volo')}}:</strong> {{ $volo->numeroVolo }}</p>
                <p><strong>{{trans('messages.compagnie')}}:</strong> {{ $volo->compagnia->nome }}</p>
                <p><strong>{{trans('messages.aeroportoP')}}:</strong> {{ $volo->aereoportoPartenza->nome }}</p>
                <p><strong>{{trans('messages.oraPartenza')}}:</strong>
                    {{ \Carbon\Carbon::parse($volo->orarioPartenza)->format('H:i') }}</p>
                <p><strong>{{trans('messages.aeroportoA')}}:</strong> {{ $volo->aereoportoArrivo->nome }}</p>
                <p><strong>{{trans('messages.oraArrivo')}}:</strong>
                    {{ \Carbon\Carbon::parse($volo->orarioArrivo)->format('H:i') }}
                    @if(\Carbon\Carbon::parse($volo->orarioPartenza)->format('d/m') != \Carbon\Carbon::parse($volo->orarioArrivo)->format('d/m'))
                        <sup>+1</sup>
                    @endif
                </p>
                <p><strong>{{trans('messages.dataPartenza')}}:</strong>
                    {{ \Carbon\Carbon::parse($volo->orarioPartenza)->format('d/m/Y') }}</p>

                @php
                    $orarioPartenza = \Carbon\Carbon::parse($volo->orarioPartenza);
                    $orarioArrivo = \Carbon\Carbon::parse($volo->orarioArrivo);
                    $differenza = $orarioPartenza->diff($orarioArrivo);
                @endphp

                <p><strong>{{trans('messages.distanza')}}:</strong>
                    @php
                        $distance = calculateDistance($volo->aereoportoPartenza, $volo->aereoportoArrivo);
                        echo $distance;
                    @endphp
                </p>
                <p><strong>{{trans('messages.durata_delVolo')}}:</strong> {{ $differenza->format('%h ore e %I minuti') }}
                </p>
            </div>

            <div id="map" class="col-md-6 text-right my-4" style="width: 500px; height: 400px">
            </div>
        </div>
    </div>

    <div class="container mb-3">
        <div class="row justify-content-center">
            @if((isset($_SESSION['logged'])) && ($_SESSION['logged']))
                @if ($_SESSION['ruolo'] == 'inserimento')
                    <div class="col-md-8 text-center">
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <a href="{{route("voli.edit", $volo->id)}}" class="btn btn-warning btn-block"><i
                                        class="bi bi-pencil-square"></i>
                                    {{trans('messages.modifica')}}</a>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                @if($volo->prenotazioni->count() > 0)
                                    <a class="btn btn-secondary btn-block" disabled="disabled"><i class="bi bi-ban"></i>
                                        {{trans('messages.elimina')}}</a>
                                @else
                                    <a class="btn btn-danger btn-block" href="{{route('voli.destroy.confirm', $volo->id)}}"><i
                                            class="bi bi-trash"></i>
                                        {{trans('messages.elimina')}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if ($_SESSION['ruolo'] == 'cliente')
                    <div class="col-md-8 text-center">
                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <a href="{{ route("prenotazioni.edit", $volo->id) }}" class="btn btn-primary btn-block">
                                    <i class="bi bi-calendar-plus"></i> {{trans('messages.prenota')}}
                                </a>

                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@else
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-danger text-center" role="alert">
                    <span class="bi bi-lock-fill" style="font-size: 2rem;"></span>
                    <h4 class="alert-heading">{{trans('messages.access_denied')}}!</h4>
                    {{trans('messages.noPermessi')}}<br>
                    {{trans('messages.vologestitoNondatuaCompagnia')}}</p>
                </div>
            </div>
        </div>
    </div>
@endif



<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<script>
    var partenza = @json($volo->aereoportoPartenza);
    var arrivo = @json($volo->aereoportoArrivo);


    var distanza = Math.sqrt(Math.pow(partenza["lat"] - arrivo["lat"], 2) + Math.pow(partenza["lon"] - arrivo["lon"], 2));


    var zoomMap = 7;
    if (distanza > 10 && distanza < 20) {
        zoomMap = 5
    } else if (distanza >= 20 && distanza < 40) {
        zoomMap = 4;
    }
    else if (distanza >= 3 && distanza < 10) {
        zoomMap = 6;
    }
    else if (distanza > 40 && distanza < 100) {
        zoomMap = 3;
    }
    else if (distanza >= 100 && distanza < 160) {
        zoomMap = 2;
    }
    else if (distanza >= 160) {
        zoomMap = 1;
    }

    // Creating map options
    var mapOptions = {
        center: [(partenza["lat"] + arrivo["lat"]) / 2, (partenza["lon"] + arrivo["lon"]) / 2],
        zoom: zoomMap
    }

    // Creating a map object
    var map = new L.map('map', mapOptions);

    // Creating a Layer object
    var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

    // Adding layer to the map
    map.addLayer(layer);

    var marker = L.marker([partenza["lat"], partenza["lon"]]).addTo(map);
    var marker2 = L.marker([arrivo["lat"], arrivo["lon"]]).addTo(map);

    var polygon = L.polygon([
        [partenza["lat"], partenza["lon"]],
        [arrivo["lat"], arrivo["lon"]]
    ]).addTo(map);

    marker.bindPopup(partenza["nome"]);
    marker2.bindPopup(arrivo["nome"]);

</script>
@php
    function calculateDistance($partenza, $arrivo)
    {

        // Definizione delle coordinate di partenza e arrivo
        $lat1 = $partenza["lat"];
        $lon1 = $partenza["lon"];
        $lat2 = $arrivo["lat"];
        $lon2 = $arrivo["lon"];

        $earth_radius = 6371; // Raggio medio della Terra in chilometri

        // Conversione delle coordinate in radianti
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Calcolo delle differenze di latitudine e longitudine
        $delta_lat = $lat2 - $lat1;
        $delta_lon = $lon2 - $lon1;

        // Applicazione della formula dell'emisenoverso
        $a = sin($delta_lat / 2) * sin($delta_lat / 2) + cos($lat1) * cos($lat2) * sin($delta_lon / 2) * sin($delta_lon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earth_radius * $c;

        // Formattazione del risultato senza cifre decimali e con "KM" alla fine
        $formatted_distance = number_format($distance, 0, '', '') . " KM";

        return $formatted_distance;
    }
@endphp
@endsection