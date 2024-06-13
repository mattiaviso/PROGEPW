@extends('layouts.master')

@section('title', 'Lista Addetti alle Prenotazioni')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">
                Lista Addetti alle Prenotazioni
            </li>
        </ol>
    </nav>
</div>
@endsection


@section('body')
<div class="container mt-4 ">
    <div class="col-xs-6 d-flex justify-content-end">
        <a href="{{route("addetti.create") }}" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i>
            {{trans("messages.aggiungiAccountAddetto")}}</a>
    </div>
</div>

<div class="container mt-4">
    <div class="col-md-12">
        <table class="table table-hover">
            <col width='10%'>
            <col width='10%'>
            <col width='20%'>
            <col width='30%'>
            <col width='15%'>
            <col width='15%'>
            <thead>
                <tr>
                    <th>{{trans("messages.nome")}}</th>
                    <th>{{trans("messages.cognome")}}</th>
                    <th>{{trans("messages.nomeCompagnia")}}</th>
                    <th>{{trans("messages.email")}}</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($utenti as $addetto)
                    <tr>
                        <td>
                            <h6>{{$addetto->nome}}</h6>
                        </td>
                        <td>
                            <h6>{{$addetto->cognome}}</h6>
                        </td>
                        <td>
                            <h6>{{$addetto->compagnia->nome}}</h6>
                        </td>
                        <td>
                            <h6>{{$addetto->email}}</h6>
                        </td>

                        <td>
                            <a class="btn btn-warning" href="{{route("addetti.edit", $addetto->id)}}"><i
                                    class="bi bi-pencil-square"></i> {{trans("messages.modifica")}}</a>
                        </td>
                        <td>
                            <a class="btn btn-danger" href="{{route("addetti.delete", $addetto->id)}}"><i
                                    class="bi bi-trash"></i> {{trans("messages.elimina")}}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection