@extends('layouts.master')

@section('title')
{{trans("messages.pagenotfound")}}
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
        <div class="col-md-6">
            <div class="card text-center shadow">
                <div class="card-header bg-warning text-white">
                    <h4><i class="bi bi-exclamation-triangle-fill"></i> {{ trans('messages.attenzione') }}</h4>
                </div>
                <div class="card-body">
                    <h1><i class="bi bi-exclamation-circle text-danger"></i> {{ trans('messages.errore') }}</h1>
                    @if (isset($message))
                        <p>{{ $message }}</p>
                    @else
                        <p>{{ trans('messages.paginaNonTrovata') }}</p>
                    @endif
                    <a href="{{ route('home') }}" class="btn btn-primary">{{ trans('messages.tornallaHome') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection