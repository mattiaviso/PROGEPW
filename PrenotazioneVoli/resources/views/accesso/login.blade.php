@extends('layouts.master')

@section('title', 'Login')


@section('body')
<div class="tab-pane active" id="login-tab">
    <form id="login-form" action="{{ route('user.login') }}" method="post">
        @csrf
        <div class="form-group mb-3">
            <input type="text" name="email" class="form-control" placeholder="Email..." />
        </div>
        <span class="invalid-input" id="invalid-email"></span>

        <div class="form-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password..." />
        </div>
        <span class="invalid-input" id="invalid-password"></span>

        <div class="form-group text-center mb-3">
            <label for="login-submit" class="btn btn-primary w-100"><i class="bi bi-door-open"></i> Login</label>
            <input id="login-submit" class="d-none" type="submit" value="Login">
        </div>


    </form>
</div>


@endsection