@extends('layouts.master')


@section('title', 'Modifica Aeroporto')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{route('aereoporti.index')}}">Lista Aeroporti</a>
            </li>
            @if(isset($airport->id))
                <li class="breadcrumb-item active" aria-current="page">Modifica Aeroporto</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">Aggiungi Aeroporto</li>
            @endif
        </ol>
    </nav>
</div>

@endsection

@section('body')
<div class="container mt-3 mb-5">

    <div class="row">
        <div class="col-md-12">
            @if(isset($airport->id))
                <form class="form-horizontal" name="airport" id="formCrea" method="post"
                    action="{{ route('aereoporti.update', ['aereoporti' => $airport->id]) }}">
                    @method('PUT')
            @else
                <form class="form-horizontal" name="airport" method="post" id="formCrea"
                    action="{{ route('aereoporti.store') }}">
            @endif
                    @csrf
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Nome Aeroporto</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="nome" placeholder="Nome Aeroporto"
                                    value="{{ $airport->nome }}" />
                            @else
                                <input class="form-control" type="text" name="nome" placeholder="Nome Aeroporto" />
                            @endif
                            <span class="text-danger" id="invalid-nome"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Città</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="city" placeholder="Città"
                                    value="{{ $airport->city }}" />
                            @else
                                <input class="form-control" type="text" name="city" placeholder="Città" />
                            @endif
                            <span class="text-danger" id="invalid-city"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Nazione</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="country" placeholder="Nazione"
                                    value="{{ $airport->country }}" />
                            @else
                                <input class="form-control" type="text" name="country" placeholder="Nazione" />
                            @endif
                            <span class="text-danger" id="invalid-country"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Codice IATA</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="code" placeholder="Codice IATA"
                                    value="{{ $airport->codice_iata }}" />
                                <input type="hidden" name="old_code" value="{{ $airport->codice_iata }}">
                            @else
                                <input class="form-control" type="text" name="code" placeholder="Codice IATA" />
                            @endif
                            <span class="text-danger" id="invalid-code"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Latitudine</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="lat" placeholder="Latitudine"
                                    value="{{ $airport->lat }}" />
                            @else
                                <input class="form-control" type="text" name="lat" placeholder="Latitudine" />
                            @endif
                            <span class="text-danger" id="invalid-lat"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Longitudine</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="lon" placeholder="Longitudine"
                                    value="{{ $airport->lon }}" />
                            @else
                                <input class="form-control" type="text" name="lon" placeholder="Longitudine" />
                            @endif
                            <span class="text-danger" id="invalid-lon"></span>

                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-10 offset-md-2">
                            <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i>
                                Salva</label>
                            <input id="mySubmit" class="d-none" type="submit" value="Save">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-10 offset-md-2">
                            <a class="btn btn-secondary w-100" href="{{ url()->previous() }}"><i
                                    class="bi bi-box-arrow-left"></i> Cancella</a>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        isValid = true;

        $('#formCrea').submit(function (event) {

            if ($('input[name="nome"]').val().trim() === '') {
                isValid = false;
                $("#invalid-nome").text("Il campo nome non può essere vuoto.");
                event.preventDefault();
                $("input[name='nome']").focus();
            } else {
                $("#invalid-nome").text("");
            }

            var cityValue = $('input[name="city"]').val().trim();
            var cityRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
            if (!cityRegex.test(cityValue)) {
                isValid = false;
                $("#invalid-city").text("Il campo città può contenere solo lettere e accenti.");
                event.preventDefault();
                $("input[name='city']").focus();
            } else {
                $("#invalid-city").text("");
            }


            var countryValue = $('input[name="country"]').val().trim();
            var countryRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
            if (!countryRegex.test(countryValue)) {
                isValid = false;
                $("#invalid-country").text("Il campo nazione può contenere solo lettere e accenti.");
                event.preventDefault();
                $("input[name='country']").focus();
            } else {
                $("#invalid-country").text("");
            }


            var codeValue = $('input[name="code"]').val().trim();
            var codeRegex = /^[a-zA-Z]{3}$/;
            if (!codeRegex.test(codeValue)) {
                isValid = false;
                $("#invalid-code").text("Il campo codice IATA deve contenere esattamente tre lettere.");
                event.preventDefault();
                $("input[name='code']").focus();
            } else {
                $("#invalid-code").text("");
            }


            var latValue = $('input[name="lat"]').val().trim();
            var latRegex = /^-?\d+(\.\d+)?$/;
            if (!latRegex.test(latValue)) {
                isValid = false;
                $("#invalid-lat").text("Inserire un valore numerico valido per la latitudine.");
                event.preventDefault();
                $("input[name='lat']").focus();
            } else {
                var latFloat = parseFloat(latValue);
                if (latFloat < -90 || latFloat > 90) {
                    isValid = false;
                    $("#invalid-lat").text("Il valore della latitudine deve essere compreso tra -90 e 90.");
                    event.preventDefault();
                    $("input[name='lat']").focus();
                } else {
                    $("#invalid-lat").text("");
                }
            }


            var lonValue = $('input[name="lon"]').val().trim();
            var lonRegex = /^-?\d+(\.\d+)?$/;
            if (!lonRegex.test(lonValue)) {
                isValid = false;
                $("#invalid-lon").text("Inserire un valore numerico valido per la longitudine.");
                event.preventDefault();
                $("input[name='lon']").focus();
            } else {
                var lonFloat = parseFloat(lonValue);
                if (lonFloat < -180 || lonFloat > 180) {
                    isValid = false;
                    $("#invalid-lon").text("Il valore della longitudine deve essere compreso tra -180 e 180.");
                    event.preventDefault();
                    $("input[name='lon']").focus();
                } else {
                    $("#invalid-lon").text("");
                }
            }

            var old_code = $('input[name="old_code"]').val();

            if (isValid) {
                event.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: '/ajaxCheckAirportCode',
                    data: { code: $('input[name="code"]').val().trim() },

                    success: function (data) {
                        if (!data.found || old_code === $('input[name="code"]').val().trim()) {
                            $("form")[0].submit();
                        } else {
                            $("#invalid-code").text("Il codice IATA inserito è già presente nel database.");

                        }
                    }
                });
            }
        });

    });
</script>


@endsection