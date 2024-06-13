@extends('layouts.master')

@section('title')
{{trans("messages.cancellaCompagnia")}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{route('compagnie.index')}}">{{trans("messages.lista_compagnie")}}</a>
            </li>


            <li class="breadcrumb-item active" aria-current="page">
                {{trans("messages.cancellaCompagnia")}}
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('body')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-6 text-center mt-5 mb-5">
            <h3>{{trans("messages.sureDeleteCompagnia")}} {{$compagnia->nome}}?</h3>
            <p>{{trans("messages.unaVoltaEseguita")}}</p>

            <form name="compagnia" method="post"
                action="{{ route('compagnie.destroy', ['compagnie' => $compagnia->id]) }}">
                @method('DELETE')
                @csrf
                <a href="{{route('compagnie.index')}}" class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i>
                    {{trans("messages.annulla")}}</a>
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i>
                    {{trans("messages.elimina")}}</button>
            </form>
        </div>
    </div>
</div>
@endsection