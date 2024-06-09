@extends('layouts.master')

@section('body')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <div class="card-header text-left">404 Error</div>

                <div class="card-body">
                    <h1>Page Not Found</h1>
                    @if (isset($message))
                        <p>{{ $message }}</p>
                    @else
                        <p>The page you are looking for does not exist.</p>
                    @endif
                    <a href="{{ route('home') }}" class="btn btn-primary">Torna alla Home</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection