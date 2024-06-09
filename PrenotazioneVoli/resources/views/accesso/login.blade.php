@extends('layouts.master')

@section('title', 'Login')


@section('body')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Accedi al tuo account</h2>
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form id="login-form" action="{{ route('user.login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                </div>
                                <input type="text" name="email" class="form-control" placeholder="Email...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="Password...">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"><i
                                    class="bi bi-box-arrow-in-right"></i>
                                Accedi</button>
                        </div>
                    </form>
                    <p class="text-center">Non hai un account? <a href="{{ route('user.register') }}">Crea un
                            nuovo
                            account</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection