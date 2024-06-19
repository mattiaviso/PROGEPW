@extends('layouts.master')

@section('title')
{{trans("messages.aggiungiAccountAddetto")}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url()->previous()}}">{{trans("messages.listaUtenze")}}</a>
            </li>
            @if(isset($addetti->id))
                <li class="breadcrumb-item active" aria-current="page">
                    {{trans("messages.modificaAccountAddetto")}}
                </li>
            @else
                <li class="breadcrumb-item active" aria-current="page">
                    {{trans("messages.aggiungiAccountAddetto")}}
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
            @if(isset($addetti->id))
                <form class="form-horizontal" name="addetti" id="formCrea" method="post"
                    action="{{ route('addetti.update', ['addetti' => $addetti->id]) }}">
                    @method('PUT')
            @else
                <form class="form-horizontal" name="addetti" method="post" id="formCrea"
                    action="{{ route('addetti.store') }}">
            @endif
                    @csrf
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.nome")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($addetti->id))
                                <input class="form-control" type="text" name="nome" placeholder="{{trans("messages.nome")}}"
                                    value="{{ $addetti->nome }}" />
                            @else
                                <input class="form-control" type="text" name="nome"
                                    placeholder="{{trans("messages.nome")}}" />
                            @endif
                            <span class="text-danger" id="invalid-nome"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.cognome")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($addetti->id))
                                <input class="form-control" type="text" name="cognome"
                                    placeholder="{{trans("messages.cognome")}}" value="{{ $addetti->cognome }}" />
                            @else
                                <input class="form-control" type="text" name="cognome"
                                    placeholder="{{trans("messages.cognome")}}" />
                            @endif
                            <span class="text-danger" id="invalid-cognome"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.dataNascita")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($addetti->id))
                                <input class="form-control" type="date" name="data"
                                    placeholder="{{trans("messages.dataNascita")}}" value="{{ $addetti->dataNascita }}" />
                            @else
                                <input class="form-control" type="date" name="data"
                                    placeholder="{{trans("messages.dataNascita")}}" />
                            @endif
                            <span class="text-danger" id="invalid-data"></span>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">{{trans("messages.luogoNascita")}}</label>
                        </div>
                        <div class="col-md-10">
                            @if(isset($addetti->id))
                                <input class="form-control" type="text" name="luogo"
                                    placeholder="{{trans("messages.luogoNascita")}}" value="{{ $addetti->luogoNascita }}" />
                            @else
                                <input class="form-control" type="text" name="luogo"
                                    placeholder="{{trans("messages.luogoNascita")}}" />
                            @endif
                            <span class="text-danger" id="invalid-luogo"></span>

                        </div>
                    </div>


                    @if(isset($addetti->id) && $addetti->ruolo == "cliente")


                    @else
                        <div class="form-group">
                            <div class=" form-group row mb-3">
                                <div class="col-md-2">
                                    <label for="title">{{trans("messages.nomeCompagnia")}}</label>
                                </div>
                                <div class="col-md-10">
                                    <select class="form-control" name="compagnia" id="compagniaSelect">
                                        <option value="" selected disabled>{{ trans('messages.selezionaCompagnia') }}
                                        </option>
                                        @foreach($companies as $comp)
                                            @if((isset($addetti->id)) && ($addetti->compagnia_id == $comp->id))
                                                <option value="{{ $comp->id }}" selected="selected">
                                                    {{ $comp->nome }}
                                                </option>
                                            @else
                                                <option value="{{ $comp->id }}">
                                                    {{ $comp->nome }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="invalid-compagnia"></span>
                                </div>
                            </div>
                    @endif


                        @php
                            $ruoli = ["prenotazioni", "inserimento"];

                        @endphp


                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label for="title">{{trans("messages.ruolo")}}</label>
                            </div>
                            <div class="col-md-10">
                                @if(isset($addetti->id) && $addetti->ruolo == "cliente")
                                    <input class="form-control" type="text" name="ruolo"
                                        value="{{trans("messages.cliente")}}" readonly />
                                @else
                                    <select class="form-control" name="ruolo">
                                        @foreach($ruoli as $ruolo)
                                            @if((isset($addetti->id)) && ($addetti->ruolo == $ruolo))
                                                <option value="{{ $ruolo }}" selected="selected">
                                                    {{ strtoupper($ruolo) }}
                                                </option>
                                            @else
                                                <option value="{{ $ruolo }}">
                                                    {{ strtoupper($ruolo) }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                <label for="title">{{trans("messages.email")}}</label>
                            </div>
                            <div class="col-md-10">
                                @if(isset($addetti->id))
                                    <input class="form-control" type="text" name="email"
                                        placeholder="{{trans("messages.email")}}" value="{{ $addetti->email }}" />
                                    <input type="hidden" name="old_email" value="{{ $addetti->email }}">
                                @else
                                    <input class="form-control" type="text" name="email"
                                        placeholder="{{trans("messages.email")}}" />
                                @endif
                                <span class="text-danger" id="invalid-email"></span>

                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-2">
                                @if(isset($addetti->id))
                                    <label hidden for="title">{{trans("messages.passw")}}</label>
                                @else
                                    <label for="title">{{trans("messages.passw")}}</label>
                                @endif

                            </div>
                            <div class="col-md-10">
                                @if(isset($addetti->id))
                                    <input hidden class="form-control" type="password" name="password"
                                        placeholder="{{trans("messages.passw")}}" value="{{ $addetti->password }}" />
                                    <input type="hidden" name="old_password" value="{{ $addetti->password }}">
                                @else
                                    <input class="form-control" type="password" name="password"
                                        placeholder="{{trans("messages.passw")}}" />
                                @endif
                                <span class="text-danger" id="invalid-password"></span>

                            </div>
                        </div>



                        <div class="form-group row mb-3">
                            <div class="col-md-10 offset-md-2">
                                <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i>
                                    {{trans("messages.salvaModifiche")}}</label>
                                <input id="mySubmit" class="d-none" type="submit" value="Save">
                            </div>
                        </div>

                </form>

                @if(isset($addetti->id))
                    <div class="container mb-3">
                        <form id="changePasswordForm" action="{{route('admin.aggiornaPass')}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <strong><label for="passwordnew1">{{trans("messages.nuovaPassword")}}</label></strong>
                                    <input type="hidden" class="form-control" id="passwordnew1" name="idCliente"
                                        placeholder="id" value="{{$addetti->id}}">
                                </div>
                                <div class="form-group col-md-9">
                                    <input type="password" class="form-control" id="passwordnew1" name="passwordnew1"
                                        placeholder="{{trans("messages.nuovaPassword")}}">
                                    <span class="text-danger error-text password_error"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <strong><label
                                            for="passwordnew2">{{trans("messages.confermaNuovaPassword")}}</label></strong>
                                </div>
                                <div class="form-group col-md-9">

                                    <input type="password" class="form-control" id="passwordnew2" name="passwordnew2"
                                        placeholder="{{trans("messages.confermaNuovaPassword")}}">
                                    <span class="text-danger error-text password_confirm_error"></span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary col-md-4" id="salva"><i
                                            class="bi bi-floppy2-fill"></i>
                                        {{trans("messages.SalvaCambioPassword")}}</button>
                                </div>
                            </div>
                    </div>
                @endif






                <div class="form-group row mb-3">
                    <div class="col-md-10 offset-md-2">
                        <a class="btn btn-secondary w-100" href="{{ url()->previous() }}"><i
                                class="bi bi-box-arrow-left"></i> {{trans("messages.cancella")}}</a>
                    </div>
                </div>
        </div>
    </div>
</div>


<script>

    $(document).ready(function () {

        $("#formCrea").submit(function (event) {

            isValid = true;


            var countryValue = $('input[name="nome"]').val().trim();
            var countryRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
            if (!countryRegex.test(countryValue)) {
                isValid = false;
                $("#invalid-nome").text("{{trans("messages.obbligatorioEsololettereeAccenti")}}");
                event.preventDefault();
                $("input[name='nome']").focus();
            } else {
                $("#invalid-nome").text("");
            }


            var countryValue = $('input[name="cognome"]').val().trim();
            var countryRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
            if (!countryRegex.test(countryValue)) {
                isValid = false;
                $("#invalid-cognome").text("{{trans("messages.obbligatorioEsololettereeAccenti")}}");
                event.preventDefault();
                $("input[name='cognome']").focus();
            } else {
                $("#invalid-cognome").text("");
            }

            var countryValue = $('input[name="luogo"]').val().trim();
            var countryRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
            if (!countryRegex.test(countryValue)) {
                isValid = false;
                $("#invalid-luogo").text("{{trans("messages.obbligatorioEsololettereeAccenti")}}");
                event.preventDefault();
                $("input[name='luogo']").focus();
            } else {
                $("#invalid-luogo").text("");
            }


            //CONTROLLO SU COMPAGNIA DIVERSO DA ''
            var compagniaValue = $('#compagniaSelect').val();
            if (compagniaValue === "" || compagniaValue === null) {
                isValid = false;
                $("#invalid-compagnia").text("{{trans("messages.campoObbligatorio")}}");
                event.preventDefault();
                $('#compagniaSelect').focus();
            } else {
                $("#invalid-compagnia").text("");
            }



            var dataValue = $("input[name='data']").val();
            if (dataValue.trim() === '') {
                $("#invalid-data").text("{{trans("messages.dataNascitaObbigatoria")}}");
                event.preventDefault();
                $("input[name='data']").focus();
            } else {
                var inputDate = new Date(dataValue);
                var tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                if (inputDate >= tomorrow) {
                    $("#invalid-data").text("{{trans("messages.dataNscitaNonFuture")}}");
                    event.preventDefault();
                    $("input[name='data']").focus();
                } else {
                    $("#invalid-data").text("");
                }
            }


            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var email = $('input[name="email"]').val().trim();
            if (!emailPattern.test(email)) {
                isValid = false;
                $("#invalid-email").text("{{trans("messages.erroreEmail")}}");
                event.preventDefault();
                $("input[name='email']").focus();
            } else {
                $("#invalid-email").text("");
            }

            // var password = $('input[name="password"]').val().trim();
            // var old;
            // if ($('input[name="old_email"]').length) {
            //     old = $('input[name="old_password"]').val().trim();
            // }


            // if (old !== password) {
            //     const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
            //     if (password == "") {
            //         isValid = false;
            //         $("#invalid-password").text("{{trans("messages.passwordObbligatoria")}}");
            //         event.preventDefault();
            //         $("input[name='password']").focus();
            //     }
            //     else if (!passwordPattern.test(password)) {
            //         isValid = false;
            //         $("#invalid-password").text("{{trans("messages.passwordNonValida")}}");
            //         event.preventDefault();
            //         $("input[name='password']").focus();
            //     } else {
            //         $("#invalid-password").text("");
            //     }
            // }

            if (isValid) {
                var old_code = $('input[name="old_email"]').val();

                event.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: '/ajaxMail',
                    data: { email: $('input[name="email"]').val().trim() },

                    success: function (data) {
                        if (!data.found || old_code === $('input[name="email"]').val().trim()) {
                            $("form")[0].submit();
                        } else {
                            $("#invalid-email").text("{{trans("messages.emailEsistente")}}");
                            $("input[name='email']").focus();
                        }
                    }
                });
            }
        });


        $('#changePasswordForm').submit(function (e) {
            isvVA = true;

            var password = $('input[name="passwordnew1"]').val().trim();
            var password_confirm = $('input[name="passwordnew2"]').val().trim();
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (!passwordPattern.test(password)) {
                $('.password_error').text('{{trans("messages.passwordNonValida")}}');
                isvVA = false;
                $('input[name="passwordnew1"]').focus();
                event.preventDefault();
            }

            if (password !== password_confirm) {
                $('.password_confirm_error').text('{{trans("messages.passwordNonCorrispondono")}}');
                isvVA = false;
                $('input[name="passwordnew2"]').focus();

                event.preventDefault();
            }

            if (isvVA) {
                $("form")[1].submit();
            } else {
                event.preventDefault();
            }
        });




    });
</script>
</div>
@endsection