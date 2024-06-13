@extends('layouts.master')

@section('title')
{{trans("messages.lista_aerei")}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans("messages.lista_aerei")}}
            </li>
        </ol>
    </nav>
</div>
@endsection


@section('body')
<div class="container mt-4 ">
    <div class="col-xs-6 d-flex justify-content-end">
        <a href="{{ route("aerei.create") }}" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i>
            {{trans("messages.aggiungiAereo")}}</a>
    </div>
</div>

<div class="container mt-4">
    <div class="col-md-12">
        <table class="table table-hover">
            <col width='40%'>
            <col width='40%'>
            <col width='20%'>
            <thead>
                <tr>
                    <th>{{trans("messages.nomeModello")}}</th>
                    <th class="text-center">{{trans("messages.capacitaPosti")}}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aerei as $aereo)
                    <tr>
                        <td>
                            <h6>{{$aereo->nomeModello}}</h6>
                        </td>
                        <td>
                            <h6 class="text-center">{{$aereo->capacita}}</h6>
                        </td>
                        <td>
                            @if($aereo->voli->count() > 0)
                                <a class="btn btn-secondary" disabled="disabled"><i class="bi bi-ban"></i>
                                    {{trans("messages.elimina")}}</a>
                            @else
                                <a class="btn btn-danger" href="{{route("aerei.destroy.confirm", $aereo->id)}}"><i
                                        class="bi bi-trash"></i> {{trans("messages.elimina")}}</a>

                            @endif
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection