@extends('layouts.master')


@section('title')
{{trans("messages.modificaAeroporto")}}
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
            @if(isset($airport->id))
                <li class="breadcrumb-item active" aria-current="page">{{trans("messages.modificaAeroporto")}}</li>
            @else
                <li class="breadcrumb-item active" aria-current="page">{{trans("messages.aggiungiAeroporto")}}</li>
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
                            <label for="title">{{trans("messages.nomeAeroporto")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="nome"
                                    placeholder="{{trans("messages.nomeAeroporto")}}" value="{{ $airport->nome }}" />
                            @else
                                <input class="form-control" type="text" name="nome"
                                    placeholder="{{trans("messages.nomeAeroporto")}}" />
                            @endif
                            <span class="text-danger" id="invalid-nome"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.citta")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="city"
                                    placeholder="{{trans("messages.citta")}}" value="{{ $airport->city }}" />
                            @else
                                <input class="form-control" type="text" name="city"
                                    placeholder="{{trans("messages.citta")}}" />
                            @endif
                            <span class="text-danger" id="invalid-city"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.stato")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="country"
                                    placeholder="{{trans("messages.stato")}}" value="{{ $airport->country }}" />
                            @else
                                <input class="form-control" type="text" name="country"
                                    placeholder="{{trans("messages.stato")}}" />
                            @endif
                            <span class="text-danger" id="invalid-country"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.codice_IATa")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="code"
                                    placeholder="{{trans("messages.codice_IATa")}}" value="{{ $airport->codice_iata }}" />
                                <input type="hidden" name="old_code" value="{{ $airport->codice_iata }}">
                            @else
                                <input class="form-control" type="text" name="code"
                                    placeholder="{{trans("messages.codice_IATa")}}" />
                            @endif
                            <span class="text-danger" id="invalid-code"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.latitudine")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="lat"
                                    placeholder="{{trans("messages.latitudine")}}" value="{{ $airport->lat }}" />
                            @else
                                <input class="form-control" type="text" name="lat"
                                    placeholder="{{trans("messages.latitudine")}}" />
                            @endif
                            <span class="text-danger" id="invalid-lat"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.longitudine")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($airport->id))
                                <input class="form-control" type="text" name="lon"
                                    placeholder="{{trans("messages.longitudine")}}" value="{{ $airport->lon }}" />
                            @else
                                <input class="form-control" type="text" name="lon"
                                    placeholder="{{trans("messages.longitudine")}}" />
                            @endif
                            <span class="text-danger" id="invalid-lon"></span>

                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-10 offset-md-2">
                            <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i>
                                {{trans("messages.salva")}}</label>
                            <input id="mySubmit" class="d-none" type="submit" value="Save">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-10 offset-md-2">
                            <a class="btn btn-secondary w-100" href="{{ url()->previous() }}"><i
                                    class="bi bi-box-arrow-left"></i> {{trans("messages.annulla")}}</a>
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
                $("#invalid-nome").text("{{trans("messages.campoObbligatorio")}}");
                event.preventDefault();
                $("input[name='nome']").focus();
            } else {
                $("#invalid-nome").text("");
            }

            var cityValue = $('input[name="city"]').val().trim();
            var cityRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
            if (!cityRegex.test(cityValue)) {
                isValid = false;
                $("#invalid-city").text("{{trans("messages.campoSoloLettere")}}");
                event.preventDefault();
                $("input[name='city']").focus();
            } else {
                $("#invalid-city").text("");
            }


            var countryValue = $('input[name="country"]').val().trim();
            var countryRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
            if (!countryRegex.test(countryValue)) {
                isValid = false;
                $("#invalid-country").text("{{trans("messages.campoSoloLettere")}}");
                event.preventDefault();
                $("input[name='country']").focus();
            } else {
                $("#invalid-country").text("");
            }


            var codeValue = $('input[name="code"]').val().trim();
            var codeRegex = /^[a-zA-Z]{3}$/;
            if (!codeRegex.test(codeValue)) {
                isValid = false;
                $("#invalid-code").text("{{trans("messages.iatathreelettere")}}");
                event.preventDefault();
                $("input[name='code']").focus();
            } else {
                $("#invalid-code").text("");
            }


            var latValue = $('input[name="lat"]').val().trim();
            var latRegex = /^-?\d+(\.\d+)?$/;
            if (!latRegex.test(latValue)) {
                isValid = false;
                $("#invalid-lat").text("{{trans("messages.inserireVlaoreLatitudine")}}");
                event.preventDefault();
                $("input[name='lat']").focus();
            } else {
                var latFloat = parseFloat(latValue);
                if (latFloat < -90 || latFloat > 90) {
                    isValid = false;
                    $("#invalid-lat").text("{{trans("messages.valoreCompresoTra")}}");
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
                $("#invalid-lon").text("{{trans("messages.inserireVlaoreLongitudine")}}");
                event.preventDefault();
                $("input[name='lon']").focus();
            } else {
                var lonFloat = parseFloat(lonValue);
                if (lonFloat < -180 || lonFloat > 180) {
                    isValid = false;
                    $("#invalid-lon").text("{{trans("messages.valoreCompresoTraLOn")}}");
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
                            $("#invalid-code").text("{{trans("messages.iataEsistente")}}");

                        }
                    }
                });
            }
        });

    });
</script>
@endsection