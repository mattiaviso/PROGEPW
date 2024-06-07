@extends('layouts.master')

@section('titolo')
Registrazione
@endsection

@section('breadcrumb')

@endsection





@section('body')
<form id="register-form" action="{{ route('user.register') }}" method="post">
    @csrf
    <div class="container mt-3 mb-5">

        <div class="row">

            <div class="col-md-12">
                <form class="form-horizontal" name="clienti" method="post" action="{{ route('clienti.store') }}">
                    @csrf
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Nome</label>
                        </div>
                        <div class="col-md-10">

                            <input class="form-control" type="text" name="nome" placeholder="Nome" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Cognome</label>
                        </div>
                        <div class="col-md-10">

                            <input class="form-control" type="text" name="cognome" placeholder="Cognome" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Data Di Nascita</label>
                        </div>
                        <div class="col-md-10">

                            <input class="form-control" type="date" name="data" placeholder="Data Di Nascita" />

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Luogo di Nascita</label>
                        </div>
                        <div class="col-md-10">

                            <input class="form-control" type="text" name="luogo" placeholder="Luogo di Nascita" />

                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">E-Mail</label>
                        </div>
                        <div class="col-md-10">

                            <input class="form-control" type="text" name="email" placeholder="E-Mail" />

                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <div class="col-md-2">
                            <label for="title">Password</label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="password" name="password" placeholder="Password" />
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
</form>
</div>
</div>
@endsection

<!-- @section('body')


<div class="form-group mb-3">
    <input type="text" name="name" class="form-control" placeholder="Your name..." />
</div>
<span class="invalid-input" id="invalid-name"></span>

<div class="form-group mb-3">
    <input type="text" name="registration-email" class="form-control" placeholder="Your email..." />
</div>
<span class="invalid-input" id="invalid-registrationEmail"></span>

<div class="form-group mb-3">
    <input type="password" name="registration-password" class="form-control" placeholder="Type password..." />
</div>
<span class="invalid-input" id="invalid-registrationPassword"></span>

<div class="form-group mb-3">
    <input type="password" name="confirm-password" class="form-control" placeholder="Re-type password..." />
</div>
<span class="invalid-input" id="invalid-confirmPassword"></span>

<div class="form-group text-center mb-3">
    <label for="register-submit" class="btn btn-primary w-100"><i class="bi bi-person-plus"></i> Register</label>
    <input id="register-submit" class="d-none" type="submit" value="Register">
</div>
</form>
</div>
</div>
@endsection -->