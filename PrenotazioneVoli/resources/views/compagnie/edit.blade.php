@extends('layouts.master')

@section('title')
@if(isset($compagnia))
    {{trans("messages.modificaCompagnia")}}
@else
    {{trans("messages.aggiungiCompagnia")}}
@endif

@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{route('compagnie.index')}}">{{trans("messages.lista_compagnie")}}</a>
            </li>

            @if(isset($compagnia))
                <li class="breadcrumb-item active" aria-current="page">
                    {{trans("messages.modificaCompagnia")}}
                </li>
            @else
                <li class="breadcrumb-item active" aria-current="page">
                    {{trans("messages.aggiungiCompagnia")}}
                </li>
            @endif
        </ol>
    </nav>
</div>
@endsection


@section('body')
<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-md-12">
            @if(isset($compagnia->id))
                <form class="form-horizontal" id="formCrea" name="compagnia" method="post"
                    action="{{ route('compagnie.update', ['compagnie' => $compagnia->id]) }}">
                    @method('PUT')
            @else
                <form class="form-horizontal" id="formCrea" name="compagnia" method="post"
                    action="{{ route('compagnie.store') }}">
            @endif
                    @csrf
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.nomeCompagnia")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($compagnia->id))
                                <input class="form-control" type="text" name="nome"
                                    placeholder="{{trans("messages.nomeCompagnia")}}" value="{{ $compagnia->nome }}" />
                            @else
                                <input class="form-control" type="text" name="nome"
                                    placeholder="{{trans("messages.nomeCompagnia")}}" />
                            @endif
                            <span class="text-danger" id="invalid-nome"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.sede_centrale")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($compagnia->id))
                                <input class="form-control" type="text" name="city"
                                    placeholder="{{trans("messages.sede_centrale")}}" value="{{ $compagnia->sede }}" />
                                <input type="hidden" name="old_code" value="{{ $compagnia->nome }}">
                            @else
                                <input class="form-control" type="text" name="city"
                                    placeholder="{{trans("messages.sede_centrale")}}" />
                                <input type="hidden" name="old_code" value="-1">

                            @endif
                            <span class="text-danger" id="invalid-city"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.nazioneRegistrazione")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($compagnia->id))
                                <input class="form-control" type="text" name="country"
                                    placeholder="{{trans("messages.nazioneRegistrazione")}}"
                                    value="{{ $compagnia->country }}" />
                            @else
                                <input class="form-control" type="text" name="country"
                                    placeholder="{{trans("messages.nazioneRegistrazione")}}" />
                            @endif
                            <span class="text-danger" id="invalid-country"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.annoFondazione")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($compagnia->id))
                                <input class="form-control" type="text" name="anno"
                                    placeholder="{{trans("messages.annoFondazione")}}"
                                    value="{{ $compagnia->anno_fondazione }}" />
                            @else
                                <input class="form-control" type="text" name="anno"
                                    placeholder="{{trans("messages.annoFondazione")}}" />
                            @endif
                            <span class="text-danger" id="invalid-anno"></span>
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

        $('#formCrea').submit(function (event) {
            isValid = true;


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

            var annoValue = $('input[name="anno"]').val().trim();

            if (annoValue === '' || isNaN(annoValue) || parseFloat(annoValue) <= 0) {
                isValid = false;
                $("#invalid-anno").text("{{trans("messages.inserireAnnoGretThanZero")}}");
                event.preventDefault();
                $("input[name='anno']").focus();
            } else {
                $("#invalid-anno").text("");
            }

            if (isValid) {
                var old_code = $('input[name="old_code"]').val();

                event.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: '/ajaxNomeCompagnia',
                    data: { nome: $('input[name="nome"]').val().trim() },

                    success: function (data) {
                        if (!data.found || old_code === $('input[name="nome"]').val().trim()) {
                            $("form")[0].submit();
                        } else {
                            $("#invalid-nome").text("{{trans("messages.nomecomgagniaPresente")}}");
                            $("input[name='nome']").focus();
                        }
                    }
                });
            }
        });
    });
</script>
@endsection