@extends('layouts.master')

@section('title')
{{trans("messages.cancellaAereo")}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">
                <a href="{{route('aerei.index')}}">{{trans("messages.lista_aerei")}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans("messages.cancellaAereo")}}
            </li>
        </ol>
    </nav>
</div>

@endsection

@section('body')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-6 text-center mt-5 mb-5">
            <h3>{{trans("messages.sureDeleteAereo")}} {{$aereo->nomeModello}}?</h3>
            <p>{{trans("messages.unaVoltaEseguita")}}</p>
            <form name="airport" method="post" action="{{ route('aerei.destroy', ['aerei' => $aereo->id]) }}">
                @method('DELETE')
                @csrf
                <a href="{{route('aerei.index')}}" class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i>
                    {{trans("messages.cancella")}}</a>
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i>
                    {{trans("messages.elimina")}}</button>
            </form>

        </div>
    </div>
</div>
@endsection