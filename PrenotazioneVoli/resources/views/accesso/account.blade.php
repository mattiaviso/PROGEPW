@extends('layouts.master')

@section('title', 'Account')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans('messages.profilo')}}
            </li>
        </ol>
    </nav>
</div>
@endsection



@section('body')
<form id="clienteForm" action="{{route('user.aggiorna')}}" method="post">
    @method('PUT')
    @csrf
    <div class="card-body container mt-3">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="nome">{{trans("messages.nome")}}</label>
            </div>
            <div class="form-group col-md-9">
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $cliente->nome }}">
                <span class="text-danger" id="invalid-nome"></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="cognome">{{trans("messages.cognome")}}</label>
            </div>
            <div class="form-group col-md-9">
                <input type="text" class="form-control" id="cognome" name="cognome" value="{{ $cliente->cognome }}">
                <span class="text-danger" id="invalid-cognome"></span>

            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="dataNascita">{{trans("messages.dataNascita")}}</label>
            </div>
            <div class="form-group col-md-9">
                <input type="date" class="form-control" id="dataNascita" name="dataNascita"
                    value="{{ $cliente->dataNascita }}">
                <span class="text-danger" id="invalid-data"></span>

            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="luogoNascita">{{trans("messages.luogoNascita")}}</label>
            </div>
            <div class="form-group col-md-9">
                <input type="text" class="form-control" id="luogoNascita" name="luogoNascita"
                    value="{{ $cliente->luogoNascita }}">
                <span class="text-danger" id="invalid-luogo"></span>

            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="text">{{trans("messages.email")}}</label>
            </div>
            <div class="form-group col-md-9">
                <input type="text" class="form-control" id="email" name="email" value="{{ $cliente->email }}">
                <input type="hidden" name="old_email" value="{{ $cliente->email }}">
                <span class="text-danger" id="invalid-email"></span>
            </div>
        </div>
        @if (isset($cliente->compagnia))
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="nomeCompagnia">{{trans("messages.nomeCompagnia")}}</label>
                </div>
                <div class="form-group col-md-9">
                    <input type="text" class="form-control" id="nomeCompagnia" name="nomeCompagnia"
                        value="{{ $cliente->compagnia->nome }}" readonly>

                </div>
            </div>
        @endif
        <!-- Bottone Salva -->
        <div class="form-row">
            <div class="form-group col-md-12 text-right">
                <button type="submit" class="btn btn-primary col-md-2" id="salva">{{trans("messages.salva")}}</button>
                <button type="reset" class="btn btn-secondary col-md-2"
                    id="reset">{{trans("messages.resetta")}}</button>
            </div>
        </div>
    </div>
</form>


<div class="container mb-3">
    <form id="changePasswordForm" action="{{route('user.aggiornaPass')}}" method="post">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="passwordnew1">{{trans("messages.nuovaPassword")}}</label>
            <input type="password" class="form-control" id="passwordnew1" name="passwordnew1"
                placeholder="{{trans("messages.nuovaPassword")}}">
            <span class="text-danger error-text password_error"></span>

        </div>
        <div class="form-group">
            <label for="passwordnew2">{{trans("messages.confermaNuovaPassword")}}</label>
            <input type="password" class="form-control" id="passwordnew2" name="passwordnew2"
                placeholder="{{trans("messages.confermaNuovaPassword")}}">
            <span class="text-danger error-text password_confirm_error"></span>

        </div>
        <div class="form-row">
            <div class="form-group col-md-12 text-right">
                <button type="submit" class="btn btn-primary col-md-4"
                    id="salva">{{trans("messages.SalvaCambioPassword")}}</button>
            </div>
        </div>
    </form>
</div>




<script>
    $(document).ready(function () {


        $('#clienteForm').submit(function (e) {
            isValid = true;

            var countryValue = $('input[name="nome"]').val().trim();
            var countryRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
            if (countryValue == "") {
                isValid = false;
                $("#invalid-nome").text("{{trans("messages.campoObbligatorio")}}");
                event.preventDefault();
                $("input[name='nome']").focus();
            }
            else if (!countryRegex.test(countryValue)) {
                isValid = false;
                $("#invalid-nome").text("{{trans("messages.campoSoloLettere")}}");
                event.preventDefault();
                $("input[name='nome']").focus();
            } else {
                $("#invalid-nome").text("");
            }


            var countryValue = $('input[name="cognome"]').val().trim();
            var countryRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
            if (!countryRegex.test(countryValue)) {
                isValid = false;
                $("#invalid-cognome").text("{{trans("messages.campoObbligatorio")}}");
                event.preventDefault();
                $("input[name='cognome']").focus();
            } else {
                $("#invalid-cognome").text("");
            }


            var countryValue = $('input[name="luogoNascita"]').val().trim();
            var countryRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
            if (countryValue == "") {
                isValid = false;
                $("#invalid-luogo").text("{{trans("messages.luogoNascitaObbligatorio")}}");
                event.preventDefault();
                $("input[name='luogoNascita']").focus();
            }
            else if (!countryRegex.test(countryValue)) {
                isValid = false;
                $("#invalid-luogo").text("{{trans("messages.campoSoloLettere")}}");
                event.preventDefault();
                $("input[name='luogoNascita']").focus();
            } else {
                $("#invalid-luogo").text("");
            }

            var dataValue = $("input[name='dataNascita']").val();
            if (dataValue.trim() === '') {
                isValid = false;
                $("#invalid-data").text("{{trans("messages.dataNascitaObbigatoria")}}");
                event.preventDefault();
                $("input[name='dataNascita']").focus();
            } else {
                var inputDate = new Date(dataValue);
                var tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                if (inputDate >= tomorrow) {
                    isValid = false;
                    $("#invalid-data").text("{{trans("messages.dataNscitaNonFuture")}}");
                    event.preventDefault();
                    $("input[name='dataNascita']").focus();
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


@endsection