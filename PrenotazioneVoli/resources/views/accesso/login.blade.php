@extends('layouts.master')

@section('title', '{{trans("messages.login")}}')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans('messages.login')}}
            </li>
        </ol>
    </nav>
</div>
@endsection


@section('body')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">{{trans('messages.accediAltuoAccount')}}</h2>
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
                                {{trans('messages.login')}}</button>
                        </div>
                    </form>
                    <p class="text-center">{{trans('messages.nonHaiAccount')}} <a
                            href="{{ route('user.register') }}">{{trans('messages.registratiOra')}}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection