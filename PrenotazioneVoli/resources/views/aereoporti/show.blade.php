@extends('layouts.master')

@section('title')
{{trans("messages.airportDetails")}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{route('aereoporti.index')}}">{{trans("messages.lista_aeroporti")}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{$airport->nome}}
            </li>
        </ol>
    </nav>
</div>

@endsection

@section('body')

<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-md-5 text-left mr-5 my-4"
            style="background-color: #f8f9fa; padding: 20px; border-radius: 10px;">
            <p><strong>{{trans("messages.nomeAeroporto")}}:</strong> {{ $airport->nome}}</p>
            <p><strong>{{trans("messages.citta")}}:</strong> {{ $airport->city}}</p>
            <p><strong>{{trans("messages.stato")}}:</strong> {{ $airport->country}}</p>
            <p><strong>{{trans("messages.codice_IATa")}}:</strong> {{ $airport->codice_iata}}</p>
            <p><strong>{{trans("messages.latitudine")}}:</strong> {{ $airport->lat}}</p>
            <p><strong>{{trans("messages.longitudine")}}:</strong> {{ $airport->lon}}</p><br>
            <p><strong>{{trans("messages.numberVoliPartenza")}}:</strong> {{ count($airport->voliPartenza) }}</p>
            <p><strong>{{trans("messages.numberVoliArrivo")}}:</strong> {{ count($airport->voliArrivo)  }}</p>

        </div>

        <div id="map" class="col-md-6 text-right my-4" style="width: 500px; height: 400px">
        </div>
    </div>

    <div class="form-group row mb-3">
        <div class="col-md-12 offset-md-0">
            <a href="{{ route("aereoporti.edit", $airport->id) }}" class="btn btn-warning w-100"><i
                    class="bi bi-pencil-fill"></i> {{trans("messages.modificaAeroporto")}}</a>
        </div>
    </div>
    <div class="form-group row mb-3">
        <div class="col-md-12 offset-md-0">
            @if(count($airport->voliPartenza) < 1)
                @if ($airport->voliArrivo->count() < 1)
                    <a class="btn btn-danger w-100" href="{{ route("aereoporti.destroy.confirm", $airport->id) }}"><i
                            class="bi bi-trash"></i> {{trans("messages.elimina")}}</a>
                @else
                    <a class="btn btn-secondary w-100" disabled="disabled"><i class="bi bi-ban"></i>
                        {{trans("messages.elimina")}}</a>
                @endif

            @else
                <a class="btn btn-secondary w-100" disabled="disabled"><i class="bi bi-ban"></i>
                    {{trans("messages.elimina")}}</a>
            @endif
        </div>
    </div>

</div>

<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<script>
    var lat = @json($airport["lat"]);
    var lon = @json($airport["lon"]);
    var nome = @json($airport["nome"]);

    // Creating map options
    var mapOptions = {
        center: [lat, lon],
        zoom: 12
    }

    // Creating a map object
    var map = new L.map('map', mapOptions);

    // Creating a Layer object
    var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');

    // Adding layer to the map
    map.addLayer(layer);

    var marker = L.marker([lat, lon]).addTo(map);

    marker.bindPopup(nome);

</script>



@endsection