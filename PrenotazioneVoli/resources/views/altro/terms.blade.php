@extends('layouts.master')

@section('title')
{{ trans("pagination.terms_and_conditions")}}
@endsection

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ trans("pagination.terms_and_conditions") }}
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('body')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">{{ trans("pagination.terms_and_conditions") }}</h1>
            <p>{{ trans("pagination.welcome_message") }}</p>

            <h2>{{ trans("pagination.acceptance_of_terms") }}</h2>
            <p>{{ trans("pagination.acceptance_of_terms_description") }}</p>

            <h2>{{ trans("pagination.use_of_website") }}</h2>
            <p>{{ trans("pagination.use_of_website_description") }}</p>

            <h2>{{ trans("pagination.registration_and_account") }}</h2>
            <p>{{ trans("pagination.registration_and_account_description") }}</p>

            <h2>{{ trans("pagination.intellectual_property") }}</h2>
            <p>{{ trans("pagination.intellectual_property_description") }}</p>

            <h2>{{ trans("pagination.limitation_of_liability") }}</h2>
            <p>{{ trans("pagination.limitation_of_liability_description") }}</p>

            <h2>{{ trans("pagination.changes_to_terms") }}</h2>
            <p>{{ trans("pagination.changes_to_terms_description") }}</p>

            <h2>{{ trans("pagination.applicable_law") }}</h2>
            <p>{{ trans("pagination.applicable_law_description") }}</p>

            <h2>{{ trans("pagination.general_provisions") }}</h2>
            <p>{{ trans("pagination.general_provisions_description") }}</p>

            <h2>{{ trans("pagination.contact_us") }}</h2>
            <p>{{ trans("pagination.contact_us_description") }}</p>

            <p>{{ trans("pagination.customer_service_message") }}</p>
        </div>
    </div>
</div>


<!-- Bottone "Torna su" -->
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