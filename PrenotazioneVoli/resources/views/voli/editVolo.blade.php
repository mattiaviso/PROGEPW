@extends('layouts.master')

@section('title', 'Inserimento Nuovi Voli')

@section('breadcrumb')

<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('addettoVoli')}}">Home Addetto Voli</a>
            </li>
            @if(isset($volo->id))
                <li class="breadcrumb-item" aria-current="page">
                    {{$volo->numeroVolo}}
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Modifica Volo
                </li>
            @else
                <li class="breadcrumb-item active" aria-current="page">
                    Inserisci Nuovo Volo
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
            @if(isset($volo->id))
                <form class="form-horizontal" name="volo" method="post" id="creaVolo"
                    action="{{ route('voli.update', ['voli' => $volo->id]) }}">
                    @method('PUT')
            @else
                <form class="form-horizontal" name="volo" method="post" id="creaVolo"
                    action="{{ route('voli.store') }}">
            @endif
                    @csrf
                    <div class="form-group row mb-3">
                        <div class="col-md-3">
                            <label for="title">Numero Volo</label>
                        </div>
                        <div class="col-md-9">
                            @if(isset($volo->id))
                                <input class="form-control" type="text" name="numero" placeholder="Numero Volo"
                                    value="{{ $volo->numeroVolo }}" />
                            @else
                                <input class="form-control" type="text" name="numero" placeholder="Numero Volo" />
                            @endif
                            <span class="text-danger" id="invalid-numero"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-3">
                            <label for="title">Aeroporto Partenza</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="partenza">
                                @foreach($aeroporti as $aeroporto)
                                    @if((isset($volo->id)) && ($volo->aereoportoPartenza_id == $aeroporto->id))
                                        <option value="{{ $aeroporto->id }}" selected="selected">
                                            {{ $aeroporto->nome }} ({{$aeroporto->codice_iata}})
                                        </option>
                                    @else
                                        <option value="{{ $aeroporto->id }}">{{ $aeroporto->nome }}
                                            ({{$aeroporto->codice_iata}})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-3">
                            <label for="title">Aeroporto Arrivo</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="arrivo">
                                @foreach($aeroporti as $aeroporto)
                                    @if((isset($volo->id)) && ($volo->aereoportoArrivo_id == $aeroporto->id))
                                        <option value="{{ $aeroporto->id }}" selected="selected">{{ $aeroporto->nome }}
                                            ({{$aeroporto->codice_iata}})</option>
                                    @else
                                        <option value="{{ $aeroporto->id }}">{{ $aeroporto->nome }}
                                            ({{$aeroporto->codice_iata}})</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger" id="invalid-arrivo"></span>

                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-3">
                            <label for="title">Ora Partenza</label>
                        </div>
                        <div class="col-md-9">
                            @if(isset($volo->id))
                                <input class="form-control" type="datetime-local" name="oraP" placeholder="Orario Partenza"
                                    value="{{ \Carbon\Carbon::parse($volo->orarioPartenza)->format('Y-m-d\TH:i') }}" />

                            @else
                                <input class="form-control" type="datetime-local" name="oraP"
                                    placeholder="Orario Partenza" />
                            @endif
                            <span class="text-danger" id="invalid-oraP"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-3">
                            <label for="title">Ora Arrivo</label>
                        </div>
                        <div class="col-md-9">
                            @if(isset($volo->id))
                                <input class="form-control" type="datetime-local" name="oraA" placeholder="Orario Arrivo"
                                    value="{{ \Carbon\Carbon::parse($volo->orarioArrivo)->format('Y-m-d\TH:i') }}" />
                            @else
                                <input class="form-control" type="datetime-local" name="oraA" placeholder="Orario Arrivo" />
                            @endif
                            <span class="text-danger" id="invalid-oraA"></span>
                            <span class="text-danger" id="invalid-ora"></span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-3">
                            <label for="title">Velivolo</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="velivolo">
                                @foreach($velivoli as $velivolo)
                                    @if((isset($volo->id)) && ($volo->aereo_id == $velivolo->id))
                                        <option value="{{ $velivolo->id }}" selected="selected">{{ $velivolo->nomeModello }}
                                        </option>
                                    @else
                                        <option value="{{ $velivolo->id }}">{{ $velivolo->nomeModello }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row mb-3">
                        <div class="col-md-9 offset-md-3">
                            <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i>
                                Salva</label>
                            <input id="mySubmit" class="d-none" type="submit" value="Save">
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-9 offset-md-3">
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

        $('#creaVolo').submit(function (event) {

            //Ora faccio i controlli sugli input
            var numeroValue = $('input[name="numero"]').val().trim();
            if (numeroValue === '') {
                isValid = false;
                $("#invalid-numero").text("Il campo numero non può essere vuoto.");
                event.preventDefault();
                $("input[name='numero']").focus();
            } else if (/[^a-zA-Z0-9]/.test(numeroValue)) {
                isValid = false;
                $("#invalid-numero").text("Il campo numero non può contenere spazi o caratteri speciali.");
                event.preventDefault();
                $("input[name='numero']").focus();
            } else {
                $("#invalid-numero").text("");
            }

            var arrivoValue = $('select[name="arrivo"]').val();
            var partenzaValue = $('select[name="partenza"]').val();

            if (arrivoValue === partenzaValue) {
                isValid = false;
                $("#invalid-arrivo").text("L'aeroporto di arrivo non può essere uguale a quello di partenza.");
                event.preventDefault();
                $('select[name="arrivo"]').focus();
            } else {
                $("#invalid-arrivo").text("");
            }

            // Controllo che i campi non siano vuoti
            var oraPValue = $('input[name="oraP"]').val();
            var oraAValue = $('input[name="oraA"]').val();

            if (oraPValue === '') {
                $("#invalid-oraP").text("Il campo ora di partenza non può essere vuoto.");
                $("input[name='oraP']").focus();
                event.preventDefault();
            } else {
                $("#invalid-oraP").text("");
            }

            if (oraAValue === '') {
                $("#invalid-ora").text("Il campo ora di arrivo non può essere vuoto.");
                $("input[name='oraA']").focus();
                event.preventDefault();
            } else {
                $("#invalid-ora").text("");
            }

            // Controllo che l'ora di arrivo sia maggiore dell'ora di partenza
            var oraPartenza = new Date(oraPValue);
            var oraArrivo = new Date(oraAValue);

            if (oraPartenza >= oraArrivo) {
                $("#invalid-oraA").text("L'ora di arrivo deve essere successiva all'ora di partenza.");
                event.preventDefault();
            } else {
                $("#invalid-oraA").text("");
            }

        });

    });
</script>


@endsection