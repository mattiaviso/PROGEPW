@extends('layouts.master')

@section('title')
{{trans("messages.aggiungiAereo")}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>

            <li class="breadcrumb-item">
                <a href="{{route('aerei.index')}}">{{trans("messages.lista_aerei")}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans("messages.aggiungiAereo")}}
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('body')
<div class="container mt-4 mb-4">
    <div class="col-md-12">
        <form id="myForm" action="{{route('aerei.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="nomeModello" class="form-label">{{trans("messages.nomeModello")}}</label>
                <input type="text" class="form-control" id="nome" name="nome">
                <span id="nomeError" class="text-danger"></span> <!-- Span per il messaggio di errore -->
            </div>
            <div class="mb-3">
                <label for="capacita" id="posti" class="form-label">{{trans("messages.capacitaPosti")}}</label>
                <input type="number" class="form-control" id="postiInput" name="posti" min="0" value="0">
                <span id="postiError" class="text-danger"></span> <!-- Span per il messaggio di errore -->
            </div>
            <button type="submit" class="btn btn-primary">{{trans("messages.aggiungi")}}</button>
        </form>
    </div>
</div>


<script>
    $(document).ready(function () {
        isValid = true;
        $('#myForm').submit(function (event) {
            if ($('#nome').val().trim() === '') {
                isValid = false;
                $('#nomeError').text('{{trans("messages.campoObbligatorio")}}');
                event.preventDefault();
            } else {
                $('#nomeError').text('');
            }

            if (parseInt($('#postiInput').val()) <= 0) {
                isValid = false;
                $('#postiError').text('{{trans("messages.campoMaggioDiZero")}}');
                event.preventDefault();
            } else {
                $('#postiError').text('');
            }

            if (!isValid) {
                event.preventDefault();
            } else {
                //controllo che nome non sia già presente
                event.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: '/ajaxNomeAereo',
                    data: { nome: $('#nome').val().trim() },
                    success: function (data) {
                        if (data.found) {
                            $('#nomeError').text('{{trans("messages.aereoGiaInserito")}}');
                        } else {
                            $("form")[0].submit();
                        }
                    }
                });
            }
        });
    });
</script>




@endsection