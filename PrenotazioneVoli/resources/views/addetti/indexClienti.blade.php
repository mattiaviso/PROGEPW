@extends('layouts.master')

@section('title', 'Lista Clienti')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Lista Utenti
            </li>
        </ol>
    </nav>
</div>
@endsection


@section('body')

<div class="container mt-4">
    <div class="col-md-12">
        <table class="table table-hover">
            <col width='20%'>
            <col width='20%'>
            <col width='30%'>
            <col width='15%'>
            <col width='15%'>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>E-Mail</th>
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
                            <h6>{{$addetto->email}}</h6>
                        </td>

                        <td>
                            <a class="btn btn-warning" href="{{route("addetti.edit", $addetto->id)}}"><i
                                    class="bi bi-pencil-square"></i> Modifica</a>
                        </td>
                        <td>
                            @if($addetto->prenotazioni->count() < 1)
                                <a class="btn btn-danger" href="{{route('addetti.delete', $addetto->id)}}"><i
                                        class="bi bi-trash"></i>
                                    Elimina</a>
                            @else
                                <a class="btn btn-secondary" disabled="disabled"><i class="bi bi-ban"></i> Elimina</a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection