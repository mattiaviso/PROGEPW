@extends('layouts.master')

@section('body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">404 Error</div>

                <div class="card-body">
                    <h1>Page Not Found</h1>
                    @if (isset($message))
                        <p>{{ $message }}</p>
                    @else
                        <p>The page you are looking for does not exist.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection