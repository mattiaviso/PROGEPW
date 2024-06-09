@extends('layouts.master')

@section('title', 'Account')

@section('body')

<form id="clienteForm" action="{{route('user.aggiorna')}}" method="post">
    @method('PUT')
    @csrf
    <div class="card-body container mt-3">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="nome">Nome</label>
            </div>
            <div class="form-group col-md-9">
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $cliente->nome }}">
                <span class="text-danger" id="invalid-nome"></span>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="cognome">Cognome</label>
            </div>
            <div class="form-group col-md-9">
                <input type="text" class="form-control" id="cognome" name="cognome" value="{{ $cliente->cognome }}">
                <span class="text-danger" id="invalid-cognome"></span>

            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="dataNascita">Data di Nascita</label>
            </div>
            <div class="form-group col-md-9">
                <input type="date" class="form-control" id="dataNascita" name="dataNascita"
                    value="{{ $cliente->dataNascita }}">
                <span class="text-danger" id="invalid-data"></span>

            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="luogoNascita">Luogo di Nascita</label>
            </div>
            <div class="form-group col-md-9">
                <input type="text" class="form-control" id="luogoNascita" name="luogoNascita"
                    value="{{ $cliente->luogoNascita }}">
                <span class="text-danger" id="invalid-luogo"></span>

            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="text">Email</label>
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
                    <label for="nomeCompagnia">Nome Compagnia</label>
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
                <button type="submit" class="btn btn-primary col-md-2" id="salva">Salva</button>
                <button type="reset" class="btn btn-secondary col-md-2" id="reset">Reset</button>
            </div>
        </div>
    </div>
</form>


<div class="container mb-3">
    <form id="changePasswordForm" action="{{route('user.aggiornaPass')}}" method="post">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="passwordnew1">Nuova Password</label>
            <input type="password" class="form-control" id="passwordnew1" name="passwordnew1"
                placeholder="Nuova Password">
            <span class="text-danger error-text password_error"></span>

        </div>
        <div class="form-group">
            <label for="passwordnew2">Conferma Nuova Password</label>
            <input type="password" class="form-control" id="passwordnew2" name="passwordnew2"
                placeholder="Conferma Nuova Password">
            <span class="text-danger error-text password_confirm_error"></span>

        </div>
        <div class="form-row">
            <div class="form-group col-md-12 text-right">
                <button type="submit" class="btn btn-primary col-md-4" id="salva">Salva Cambio Password</button>
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
                $("#invalid-nome").text("Il campo nome è obbligatorio.");
                event.preventDefault();
                $("input[name='nome']").focus();
            }
            else if (!countryRegex.test(countryValue)) {
                isValid = false;
                $("#invalid-nome").text("Il campo nome può contenere solo lettere e accenti.");
                event.preventDefault();
                $("input[name='nome']").focus();
            } else {
                $("#invalid-nome").text("");
            }


            var countryValue = $('input[name="cognome"]').val().trim();
            var countryRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
            if (!countryRegex.test(countryValue)) {
                isValid = false;
                $("#invalid-cognome").text("Il campo cognome è obbligatorio e può contenere solo lettere e accenti.");
                event.preventDefault();
                $("input[name='cognome']").focus();
            } else {
                $("#invalid-cognome").text("");
            }


            var countryValue = $('input[name="luogoNascita"]').val().trim();
            var countryRegex = /^[a-zA-ZÀ-ÿ\s]+$/;
            if (countryValue == "") {
                isValid = false;
                $("#invalid-luogo").text("Il campo luogo di nascita è obbligatorio.");
                event.preventDefault();
                $("input[name='luogoNascita']").focus();
            }
            else if (!countryRegex.test(countryValue)) {
                isValid = false;
                $("#invalid-luogo").text("Il campo luogo di nascita può contenere solo lettere e accenti.");
                event.preventDefault();
                $("input[name='luogoNascita']").focus();
            } else {
                $("#invalid-luogo").text("");
            }

            var dataValue = $("input[name='dataNascita']").val();
            if (dataValue.trim() === '') {
                $("#invalid-data").text("Il campo data di nascita è obbligatorio.");
                event.preventDefault();
                $("input[name='dataNascita']").focus();
            } else {
                var inputDate = new Date(dataValue);
                var tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                if (inputDate >= tomorrow) {
                    $("#invalid-data").text("La data di nascita non può essere futura.");
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
                $("#invalid-email").text("Inserisci un indirizzo email valido.");
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
                            $("#invalid-email").text("L\'indirizzo email inserito è già associato a un account. Inserisci un indirizzo email diverso.");
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
                $('.password_error').text('La password deve essere lunga almeno 8 caratteri, contenere almeno una lettera maiuscola, una lettera minuscola, un numero e un carattere speciale.');
                isvVA = false;
                $('input[name="passwordnew1"]').focus();
                event.preventDefault();
            }

            if (password !== password_confirm) {
                $('.password_confirm_error').text('Le password non corrispondono.');
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