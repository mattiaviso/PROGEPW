@extends('layouts.master')

@section('title')
ACCESSO BLOCCATO
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('body')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center shadow-lg">
                <div class="card-header bg-danger text-white">
                    <h4><i class="bi bi-shield-lock-fill"></i> {{ trans('messages.accessoBloccato') }}</h4>
                </div>
                <div class="card-body">
                    <h1 class="display-4"><i class="bi bi-exclamation-circle text-danger"></i>
                        {{ trans('messages.errore') }}</h1>
                    <p class="lead">{{trans('messages.MEXNOPERMESSI')}}</p>
                    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">
                        <i class="bi bi-arrow-left"></i> {{ trans('messages.tornallaHome') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection