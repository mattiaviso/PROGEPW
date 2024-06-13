@extends('layouts.master')

@section('title')
{{trans("messages.cancella_volo")}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('addettoVoli')}}">{{trans('messages.lista_voli')}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans('messages.cancella_volo')}}
            </li>
        </ol>
    </nav>
</div>

@endsection

@section('body')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-6 text-center mt-5 mb-5">
            <h3>{{trans('messages.sureEliminare')}} {{$volo->numeroVolo}}?</h3>
            <p>{{trans('messages.unaVoltaEseguita')}}</p>

            <form name="volo" method="post" action="{{ route('voli.destroy', ['voli' => $volo->id]) }}">
                @method('DELETE')
                @csrf
                <a href="{{url()->previous()}}" class="btn btn-secondary"><i class="bi bi-box-arrow-left"></i>
                    {{trans('messages.cancella')}}</a>
                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i>
                    {{trans('messages.elimina')}}</button>

            </form>

        </div>
    </div>
</div>
@endsection