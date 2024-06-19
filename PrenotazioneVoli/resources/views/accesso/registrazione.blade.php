@extends('layouts.master')

@section('titolo')
{{trans('messages.registrati')}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans('messages.registrati')}}
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('body')
<form id="register-form" action="{{ route('user.register') }}" method="post">
    @csrf
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">{{trans('messages.creaNuovoAccount')}}</h2>

                        <div class="form-group row">
                            <label for="nome" class="col-md-3 col-form-label">{{trans('messages.nome')}}
                            </label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="nome"
                                    placeholder="{{trans('messages.nome')}}">
                                <span class="text-danger error-text nome_error"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cognome" class="col-md-3 col-form-label">{{trans('messages.cognome')}}
                            </label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="cognome"
                                    placeholder="{{trans('messages.registrati')}}">
                                <span class="text-danger error-text cognome_error"></span>
                            </div>
                        </div>
                        <input type="hidden" name="ruolo" value="cliente">

                        <div class="form-group row">
                            <label for="data" class="col-md-3 col-form-label">{{trans('messages.dataNascita')}}
                            </label>
                            <div class="col-md-9">
                                <input class="form-control" type="date" name="data"
                                    placeholder="{{trans('messages.dataNascita')}}">
                                <span class="text-danger error-text data_error"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="luogo"
                                class="col-md-3 col-form-label">{{trans('messages.luogoNascita')}}</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="luogo"
                                    placeholder="{{trans('messages.luogoNascita')}}">
                                <span class="text-danger error-text luogo_error"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label">{{trans('messages.email')}}</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="email"
                                    placeholder="{{trans('messages.email')}}">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label">{{trans('messages.passw')}}</label>
                            <div class="col-md-9">
                                <input class="form-control" type="password" name="password"
                                    placeholder="{{trans('messages.passw')}}">
                                <span class="text-danger error-text password_error"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirm"
                                class="col-md-3 col-form-label">{{trans('messages.confermaPassw')}}</label>
                            <div class="col-md-9">
                                <input class="form-control" type="password" name="password_confirm"
                                    id="password_confirm" placeholder="{{trans('messages.confermaPassw')}}">
                                <span class="text-danger error-text password_confirm_error"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary btn-block"><i
                                        class="bi bi-floppy2-fill"></i> {{trans('messages.salva')}}</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block"><i
                                        class="bi bi-box-arrow-left"></i> {{trans('messages.cancella')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



<script>
    $(document).ready(function () {
        $('#register-form').submit(function (event) {

            event.preventDefault();
            $('.error-text').text(''); // Resetta i messaggi di errore

            let isValid = true;

            let nome = $('input[name="nome"]').val().trim();
            let cognome = $('input[name="cognome"]').val().trim();
            let data = $('input[name="data"]').val().trim();
            let luogo = $('input[name="luogo"]').val().trim();
            let password = $('input[name="password"]').val().trim();
            let email = $('input[name="email"]').val().trim();


            var countryRegex = /^[a-zA-ZÀ-ÿ\s]+$/;



            if (nome === '') {
                $('.nome_error').text('{{trans('messages.campoObbligatorio')}}');
                $('input[name="nome"]').focus();
                isValid = false;
                event.preventDefault();
            } else if (!countryRegex.test(nome)) {
                $('.nome_error').text('{{trans('messages.soloLettere')}}');
                $('input[name="nome"]').focus();
                isValid = false;
                event.preventDefault();
            }


            if (cognome === '') {
                $('.cognome_error').text('{{trans('messages.campoObbligatorio')}}');
                $('input[name="cognome"]').focus();
                isValid = false;
                event.preventDefault();
            } else if (!countryRegex.test(cognome)) {
                $('.cognome_error').text('{{trans('messages.soloLettere')}}');
                $('input[name="cognome"]').focus();
                isValid = false;
                event.preventDefault();
            }

            if (data.trim() === '') {
                $(".data_error").text("{{trans('messages.dataNascitaObbigatoria')}}");
                event.preventDefault();
                $("input[name='data']").focus();
            } else {
                var inputDate = new Date(data);
                var tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                if (inputDate >= tomorrow) {
                    $(".data_error").text("{{trans('messages.dataNscitaNonFuture')}}");
                    event.preventDefault();
                    $("input[name='data']").focus();
                } else {
                    $(".data_error").text("");
                }
            }

            if (luogo === '') {
                $('.luogo_error').text('{{trans('messages.luogoNascitaObbligatorio')}}');
                $('input[name="luogo"]').focus();
                isValid = false;
                event.preventDefault();
            } else if (!countryRegex.test(luogo)) {
                $('.luogo_error').text('{{trans('messages.soloLettere')}}');
                $('input[name="luogo"]').focus();
                isValid = false;
                event.preventDefault();
            }


            var password_confirm = $('#password_confirm').val().trim();

            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (!passwordPattern.test(password)) {
                $('.password_error').text('{{trans('messages.passwordNonValida')}}');
                isValid = false;
                event.preventDefault();
            }

            if (password !== password_confirm) {
                $('.password_confirm_error').text('{{trans('messages.passwordNonCorrispondono')}}');
                isValid = false;
                event.preventDefault();
            }


            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                $('.email_error').text('{{trans('messages.erroreEmail')}}');
                isValid = false;
                event.preventDefault();
            }

            if (isValid) {
                let form = this;
                event.preventDefault();


                // Effettua la richiesta AJAX
                $.ajax({
                    type: 'GET',
                    url: '/ajaxMail',
                    data: { email: email },
                    success: function (data) {
                        if (data.found) {
                            $('.email_error').text('{{trans('messages.emailEsistente')}}');
                        } else {
                            // Invia il form
                            $("form")[0].submit();
                        }
                    }
                });
            }
        });
    });
</script>

@endsection