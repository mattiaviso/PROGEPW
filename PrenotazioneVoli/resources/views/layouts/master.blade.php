<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- jQuery e plugin JavaScript  -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>


    <link href="../public/assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />


    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->

    <script>
        function increasePassenger() {
            var passengersInput = document.getElementById("passengers");
            var currentPassengers = parseInt(passengersInput.value);
            passengersInput.value = currentPassengers + 1;
        }

        function decreasePassenger() {
            var passengersInput = document.getElementById("passengers");
            var currentPassengers = parseInt(passengersInput.value);
            if (currentPassengers > 1) {
                passengersInput.value = currentPassengers - 1;
            }
        }
    </script>

    <style>
        body {
            background-color: #f0f0f0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .flight-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            position: relative;
        }

        .btn-book {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .content-wrapper {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .passengers-wrapper {
            display: flex;
            align-items: center;
        }

        .passenger-btn {
            margin: 0 5px;
        }

        a:hover {
            text-decoration: underline;
        }

        .wrapper {
            flex: 1;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="bg-dark text-white py-4">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-6">
                <div class="col-md-3">
                    <a href="{{route('home')}}" class="text-white text-decoration-none">
                        <h1 class="mb-0">VolaFacile.it</h1>
                    </a>
                </div>

                @if((isset($_SESSION['logged'])) && ($_SESSION['logged']))
                    <div class="col-md-8 text-right">
                        <label class="text-white mr-2">BENTORNATO {{ strtoupper($_SESSION['loggedName']) }} !!!</label>
                    </div>

                    @if((isset($_SESSION['logged'])) && ($_SESSION['ruolo'] === 'cliente'))


                    @endif

                    @if((isset($_SESSION['logged'])) && ($_SESSION['ruolo'] === 'prenotazioni'))
                        <div class="col-md-5 text-right">
                            <a href="#" class="text-white mr-2">prenotazioni</a>
                        </div>
                    @endif
                @else
                    <div class="col-md-9 text-right">
                        <a type="button" class="btn btn-outline-light me-2" href="{{route('user.login')}}">LOGIN</a>
                        <a type="button" class="btn btn-outline-light me-2" href="{{route('user.register')}}">REGISTRATI</a>

                    </div>
                @endif
            </div>
        </div>
    </header>



    @if((isset($_SESSION['logged'])) && ($_SESSION['logged']))
        @if ($_SESSION['ruolo'] == 'cliente')
            <div class="container mt-3">
                <nav class="navbar navbar-expand-md navbar-light bg-light">
                    <a class="navbar-brand" href="{{route('home')}}">Home</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto  mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('voli.index')}}">Prenota Volo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('prenotazioni.index')}}">Le Mie Prenotazioni</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('profilo')}}">Account</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user.logout')}}">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        @endif
        @if ($_SESSION['ruolo'] == 'admin')
            <div class="container mt-3">
                <nav class="navbar navbar-expand-md navbar-light bg-light">
                    <a class="navbar-brand" href="{{route('home')}}">Home</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto  mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('aereoporti.index') }}">Aereoporti</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('compagnie.index') }}">Compagnie</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('aerei.index') }}">Aerei</a>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Categorie Utenti
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('addetti.indexVoli') }}">Addetti Inserimento
                                            Voli</a>
                                        <a class="dropdown-item" href="{{ route('addetti.indexPrenotazioni') }}">Addetti alle
                                            Prenotazioni</a>
                                        <a class="dropdown-item" href="#">Clienti</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('profilo')}}">Account</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user.logout')}}">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        @endif
        @if ($_SESSION['ruolo'] == 'inserimento')
            <div class="container mt-3">
                <nav class="navbar navbar-expand-md navbar-light bg-light">
                    <a class="navbar-brand" href="{{route('home')}}">Home</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto  mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('addettoVoli') }}">Lista Voli</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('profilo')}}">Account</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user.logout')}}">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        @endif
        @if ($_SESSION['ruolo'] == 'prenotazioni')
            <div class="container mt-3">
                <nav class="navbar navbar-expand-md navbar-light bg-light">
                    <a class="navbar-brand" href="{{route('home')}}">Home</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto  mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('addettoPrenotazioni')}}">Lista Prenotazioni Per volo</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('profilo')}}">Account</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user.logout')}}">Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        @endif
    @endif



    <!--breadcrumb-->
    @yield('breadcrumb')


    <!-- <li class="breadcrumb-item"><a href="{{route("home")}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Voli Disponibili</li> -->






    <div class="container-fluid">
        @yield('body')
    </div>




    <div class="wrapper">
        <!-- il tuo contenuto va qui -->
    </div>
    <footer class="bg-dark text-white border-top">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <a href="/"
                        class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none text-white">
                        <h1 class="m-0">VolaFacile.it</h1>
                    </a>
                    <p class="text-muted">Il modo più semplice per prenotare i tuoi voli.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="text-white">Contatti</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <span class="nav-link p-0 text-white">Telefono: 0123456789</span>
                        </li>
                        <li class="nav-item mb-2">
                            <span class="nav-link p-0 text-white">Email: info@volafacile.it</span>
                        </li>
                        <li class="nav-item mb-2">
                            <span class="nav-link p-0 text-white">Indirizzo: Via Roma 123, Milano</span>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="text-white">Link Utili</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-white">Chi siamo</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-white">Privacy Policy</a>
                        </li>
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link p-0 text-white">Termini e condizioni</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col text-center">
                    <a href="#" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white mx-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-center">
                    <p class="text-muted">&copy; 2024 VolaFacile.it. Tutti i diritti riservati.</p>
                </div>
            </div>
        </div>
    </footer>




    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

</body>

</html>