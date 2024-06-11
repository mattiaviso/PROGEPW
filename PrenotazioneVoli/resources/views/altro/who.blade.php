@extends('layouts.master')

@section('title', 'Chi siamo')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Chi siamo
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('body')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">{{ trans("about_us.about_us_title") }}</h1>
            <p><strong>{{ trans("about_us.our_story_title") }}</strong></p>
            <p>{{ trans("about_us.our_story_description") }}</p>

            <p><strong>{{ trans("about_us.our_mission_title") }}</strong></p>
            <p>{{ trans("about_us.our_mission_description") }}</p>

            <p><strong>{{ trans("about_us.our_values_title") }}</strong></p>
            <ul>
                <li><strong>{{ trans("about_us.quality") }}</strong>: {{ trans("about_us.quality_description") }}</li>
                <li><strong>{{ trans("about_us.reliability") }}</strong>:
                    {{ trans("about_us.reliability_description") }}
                </li>
                <li><strong>{{ trans("about_us.innovation") }}</strong>: {{ trans("about_us.innovation_description") }}
                </li>
                <li><strong>{{ trans("about_us.transparency") }}</strong>:
                    {{ trans("about_us.transparency_description") }}
                </li>
            </ul>

            <p><strong>{{ trans("about_us.our_commitment_to_sustainability_title") }}</strong></p>
            <p>{{ trans("about_us.our_commitment_to_sustainability_description") }}</p>

            <p><strong>{{ trans("about_us.our_team_title") }}</strong></p>
            <p>{{ trans("about_us.our_team_description") }}</p>

            <p><strong>{{ trans("about_us.our_technology_title") }}</strong></p>
            <p>{{ trans("about_us.our_technology_description") }}</p>

            <p><strong>{{ trans("about_us.our_customer_support_title") }}</strong></p>
            <p>{{ trans("about_us.our_customer_support_description") }}</p>

            <p><strong>{{ trans("about_us.our_network_title") }}</strong></p>
            <p>{{ trans("about_us.our_network_description") }}</p>

            <p><strong>{{ trans("about_us.customer_testimonials_title") }}</strong></p>
            <p>{{ trans("about_us.customer_testimonials_description") }}</p>


            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Mario Rossi</h5>
                            <p class="card-text">
                                <span class="fa fa-star checked" style="color: gold;"></span>
                                <span class="fa fa-star checked" style="color: gold;"></span>
                                <span class="fa fa-star checked" style="color: gold;"></span>
                                <span class="fa fa-star checked" style="color: gold;"></span>
                                <span class="fa fa-star"></span>
                            </p>
                            <p class="card-text">Servizio eccellente, prenotazione facile e senza problemi. Assistenza
                                clienti molto disponibile!</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Luca Bianchi</h5>
                            <p class="card-text">
                                <span class="fa fa-star checked" style="color: gold;"></span>
                                <span class="fa fa-star checked" style="color: gold;"></span>
                                <span class="fa fa-star checked" style="color: gold;"></span>
                                <span class="fa fa-star checked" style="color: gold;"></span>
                                <span class="fa fa-star checked" style="color: gold;"></span>
                            </p>
                            <p class="card-text">Esperienza di prenotazione fantastica! Ho trovato il miglior prezzo per
                                il mio volo in pochi minuti.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sara Verdi</h5>
                            <p class="card-text">
                                <span class="fa fa-star checked" style="color: gold;"></span>
                                <span class="fa fa-star checked" style="color: gold;"></span>
                                <span class="fa fa-star checked" style="color: gold;"></span>
                                <span class="fa fa-star" style="color: gold;"></span>
                                <span class="fa fa-star"></span>
                            </p>
                            <p class="card-text">Ottima piattaforma, molto intuitiva. Qualche problema con il pagamento
                                ma risolto velocemente dal supporto.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<button onclick="topFunction()" id="scrollBtn" title="Torna su" class="btn btn-light rounded-circle shadow"
    style="position: fixed; bottom: 20px; right: 20px; display: none;">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    // Get the button
    var mybutton = document.getElementById("scrollBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () { scrollFunction(); };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
</script>

@endsection