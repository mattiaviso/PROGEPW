@extends('layouts.master')

@section('title', '{{trans("pagination.privacy")}}')

@section('breadcrumb')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-end">
            <li class="breadcrumb-item">
                <a href="{{route('home')}}"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{trans("pagination.privacy")}}
            </li>
        </ol>
    </nav>
</div>
@endsection


@section('body')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">{{ trans("pagination.privacy") }}</h1>
            <p><strong>{{ trans("pagination.general_information") }}</strong></p>
            <p>{{ trans("pagination.privacy_policy") }}</p>

            <p><strong>{{ trans("pagination.collection_usage_info") }}</strong></p>
            <p>{{ trans("pagination.collection_usage_info_description") }}</p>

            <ul>
                <li>{{ trans("pagination.contact_data") }}</li>
                <li>{{ trans("pagination.payment_data") }}</li>
                <li>{{ trans("pagination.browsing_data") }}</li>
            </ul>

            <p>{{ trans("pagination.usage_purposes") }}</p>

            <ul>
                <li>{{ trans("pagination.service_provision") }}</li>
                <li>{{ trans("pagination.user_experience") }}</li>
                <li>{{ trans("pagination.financial_transactions") }}</li>
                <li>{{ trans("pagination.website_analysis") }}</li>
            </ul>

            <p><strong>{{ trans("pagination.sharing_data") }}</strong></p>
            <p>{{ trans("pagination.sharing_data_description") }}</p>

            <ul>
                <li>{{ trans("pagination.payment_processing") }}</li>
                <li>{{ trans("pagination.service_providers") }}</li>
                <li>{{ trans("pagination.authorities") }}</li>
            </ul>

            <p><strong>{{ trans("pagination.data_protection") }}</strong></p>
            <p>{{ trans("pagination.data_protection_description") }}</p>

            <p><strong>{{ trans("pagination.changes_privacy_policy") }}</strong></p>
            <p>{{ trans("pagination.changes_privacy_policy_description") }}</p>

            <p><strong>{{ trans("pagination.contact_us") }}</strong></p>
            <p>{{ trans("pagination.contact_us_description") }}</p>
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