@extends('layouts.master')

@section('title')
@if (isset($aereo))
    {{trans("messages.modificaAereo")}}

@else
    {{trans("messages.aggiungiAereo")}}
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
                <a href="{{route('aerei.index')}}">{{trans("messages.lista_aerei")}}</a>
            </li>
            @if(isset($aereo))
                <li class="breadcrumb-item active" aria-current="page">
                    {{trans("messages.modificaAereo")}}
                </li>
            @else
                <li class="breadcrumb-item active" aria-current="page">
                    {{trans("messages.aggiungiAereo")}}
                </li>
            @endif
        </ol>
    </nav>
</div>
@endsection

@section('body')
<div class="container mt-4 mb-4">
    <div class="col-md-12">

        @if(isset($aereo))
            <form class="form-horizontal" name="aereo" id="myForm" method="post"
                action="{{ route('aerei.update', ['aerei' => $aereo->id]) }}">
                @method('PUT')
        @else
            <form id="myForm" action="{{route('aerei.store')}}" method="post">
        @endif
                @csrf
                <div class="mb-3">
                    <label for="nomeModello" class="form-label">{{trans("messages.nomeModello")}}</label>
                    @if (isset($aereo))
                        <input type="text" class="form-control" id="nome" name="nome" value="{{$aereo->nomeModello}}">
                        <input type="text" hidden class="form-control" id="nomeHidden" name="nomeHidden"
                            value="{{$aereo->nomeModello}}">
                    @else
                        <input type="text" class="form-control" id="nome" name="nome">
                        <input type="text" hidden class="form-control" id="nomeHidden" name="nomeHidden" value="-1">
                    @endif
                    <span id="nomeError" class="text-danger"></span> <!-- Span per il messaggio di errore -->
                    <span id="nomeError2" class="text-danger"></span> <!-- Span per il messaggio di errore -->

                </div>
                <div class="mb-3">
                    <label for="capacita" id="posti" class="form-label">{{trans("messages.capacitaPosti")}}</label>
                    @if (isset($aereo))
                        <input type="number" class="form-control" id="postiInput" name="posti" min="0"
                            value="{{$aereo->capacita}}">

                        <input type="text" hidden class="form-control" id="idHidden" name="idHidden"
                            value="{{$maxPassengers}}">
                    @else
                        <input type="number" class="form-control" id="postiInput" name="posti" min="0" value="0">
                        <input type="text" hidden class="form-control" id="idHidden" name="idHidden" value="-1">
                    @endif
                    <span id="postiErrorModifica" class="text-danger"></span>
                    <span id="postiError" class="text-danger"></span> <!-- Span per il messaggio di errore -->
                </div>
                @if (isset($aereo))
                    <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i>
                        {{trans('messages.salvaModifiche')}}</button>
                @else
                    <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i>
                        {{trans("messages.aggiungi")}}</button>
                @endif
            </form>
    </div>
</div>


<script>
    $(document).ready(function () {
        isValid = true;

        $('#myForm').submit(function (event) {
            isValid = true;

            nomeVecchio = $('#nomeHidden').val().trim();
            nomeNuovo = $('#nome').val().trim();

            if ($('#nome').val().trim() == '') {
                isValid = false;
                $('#nomeError').text('{{trans("messages.campoObbligatorio")}}');
                event.preventDefault();
            } else {
                $('#nomeError').text('');
            }

            if (parseInt($('#postiInput').val()) <= 0) {
                isValid = false;
                $('#postiError').text('{{trans("messages.campoMaggioDiZero")}}');
                event.preventDefault();
            } else {
                //leggi idHidden
                if (parseInt($('#idHidden').val()) > parseInt($('#postiInput').val())) {
                    isValid = false;
                    $('#postiErrorModifica').text("{{trans('messages.erroreCapacitaSbaglaito')}}");
                    event.preventDefault();
                } else {
                    $('#postiErrorModifica').text('');
                }

                $('#postiError').text('');
            }

            if (!isValid) {
                event.preventDefault();
            } else {
                //controllo che nome non sia già presente
                event.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: '/ajaxNomeAereo',
                    data: { nome: $('#nome').val().trim() },
                    success: function (data) {
                        if (data.found && nomeVecchio !== nomeNuovo) {
                            $('#nomeError2').text('{{trans("messages.aereoGiaInserito")}}');
                            isValid = false;
                        } else {
                            $("form")[0].submit();
                            $('#nomeError2').text('');
                        }
                    }
                });
            }
        });
    });

</script>

@endsection