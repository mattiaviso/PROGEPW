<?php

use App\Http\Controllers\AddettiController;
use App\Http\Controllers\AereoController;
use App\Http\Controllers\ClientiController;
use App\Http\Controllers\LangController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AereoportoController;
use App\Http\Controllers\CompagniaController;
use App\Http\Controllers\VoliController;
use App\Http\Controllers\PrenotazioniController;
use App\Models\DataLayer;
use App\Http\Controllers\AuthController;




Route::get('/lang/{lang}', [LangController::class, 'changeLanguage'])->name('setLang');

Route::get('/', [FrontController::class, 'getHome'])->name('home')->middleware(['lang']);

Route::get('/ChiSiamo', [FrontController::class, 'ChiSiamo'])->name('altro.who')->middleware(['lang']);
;
Route::get('/PrivacyPolicy', [FrontController::class, 'privacy'])->name('altro.privacy')->middleware('lang');
Route::get('/TerminiCondizioni', [FrontController::class, 'terms'])->name('altro.termini')->middleware('lang');



//fammi la rotta che mostra la view welcome
Route::get('/welcome', function () {
    $dl = new DataLayer();
    $voli = $dl->listVoli();
    return view('welcome')->with('voli', $voli);
})->name('welcome');


Route::get('/user/login', [AuthController::class, 'authentication'])->name('user.login')->middleware('lang');
;
Route::post('/user/login', [AuthController::class, 'login'])->name('user.login');

Route::get('/user/register', [AuthController::class, 'registrazione'])->name('user.register')->middleware('lang');
;
Route::post('/user/register', [AuthController::class, 'registration'])->name('user.register');
Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');


Route::get('/ajaxMail', [AuthController::class, 'ajaxCheckForEmail']);



Route::resource('clienti', ClientiController::class)->middleware('authCustom');
Route::put('profilo/aggiorna', [ClientiController::class, 'aggiorna'])->name('user.aggiorna')->middleware('authCustom');
Route::put('profilo/changePSWD', [ClientiController::class, 'aggiornaPass'])->name('user.aggiornaPass')->middleware('authCustom');


Route::group(['middleware' => ['authCustom', 'isCliente', 'lang']], function () {
    //Route::resource('clienti', ClientiController::class);
    Route::resource('prenotazioni', PrenotazioniController::class);
    Route::post('/voli/aggiorna', [PrenotazioniController::class, 'aggiorna'])->name('aggiorna');

    Route::get('/ajaxPostiDisponibili', [AuthController::class, 'ajaxCheckForPosti']);
    Route::get('/ajaxPrenotazioneGiaPresente', [AuthController::class, 'ajaxPrenotazioneGiaPresente']);

});

Route::group(['middleware' => ['authCustom', 'isAddettoVolo', 'lang']], function () {
    Route::get('/addettoVoli', function () {
        $dl = new DataLayer();
        $compagnia_id = $dl->findCompagniaByUserID($_SESSION['loggedID']);
        $voli = $dl->listVoliByCompagniaId($compagnia_id);
        return view('addettoVoli.index')->with('voli', $voli);
    })->name('addettoVoli');

    Route::get('voli/create', [VoliController::class, 'create'])->name('voli.create');     // Mostra form per creare un nuovo volo
    Route::post('voli', [VoliController::class, 'store'])->name('voli.store');             // Salva il nuovo volo creato
    Route::get('voli/{voli}/edit', [VoliController::class, 'edit'])->name('voli.edit');     // Mostra form per modificare un volo
    Route::put('voli/{voli}', [VoliController::class, 'update'])->name('voli.update');      // Salva le modifiche ad un volo
    Route::delete('voli/{voli}', [VoliController::class, 'destroy'])->name('voli.destroy'); // Cancella un volo

    Route::get('/voli/{id}/destroy/confirm', [VoliController::class, 'confirmDestroy'])->name('voli.destroy.confirm');
});

// Route::group(['middleware' => ['authCustom', 'isClienteOrVolo']], function () {
//     Route::resource('voli', VoliController::class);
//     Route::get('voli/{volo}', [VoliController::class, 'show'])->name('voli.show');
//     Route::get('/voli', [VoliController::class, 'index'])->name('voli.index');
// });

Route::get('voli/{volo}', [VoliController::class, 'show'])->name('voli.show')->middleware('authCustom')->middleware('lang');
Route::get('/voli', [VoliController::class, 'index'])->name('voli.index')->middleware('lang');
Route::get('/search/{id}', [VoliController::class, 'search'])->name('search')->middleware('lang');



Route::group(
    ['middleware' => ['authCustom', 'isAddettoPrenotazioni', 'lang']],
    function () {
        Route::get('/addettoPrenotazioni', function () {
            $dl = new DataLayer();
            $idCompagnia = $dl->findCompagniaByUserID($_SESSION['loggedID']);
            $voli = $dl->listVolibyCompagniaID($idCompagnia);
            return view('addettoPrenotazioni.index')->with('voli', $voli);
        })->name('addettoPrenotazioni');
    }
);



Route::get('/profilo', [ClientiController::class, 'profilo'])->name('profilo')->middleware('authCustom')->middleware('lang');


Route::group(['middleware' => ['authCustom', 'isAdmin', 'lang']], function () {
    Route::resource('aereoporti', AereoportoController::class);
    Route::get('/aereoporti/{id}/destroy/confirm', [AereoportoController::class, 'confirmDestroy'])->name('aereoporti.destroy.confirm');
    Route::resource('compagnie', CompagniaController::class);
    Route::get('/compagnie/{id}/destroy/confirm', [CompagniaController::class, 'confirmDestroy'])->name('compagnie.destroy.confirm');
    Route::resource('aerei', AereoController::class);
    Route::get('/aerei/{id}/destroy/confirm', [AereoController::class, 'confirmDestroy'])->name('aerei.destroy.confirm');

    Route::resource('addetti', AddettiController::class);
    Route::get('/addetti/{id}/destroy/confirm', [AddettiController::class, 'confirmDestroy'])->name('addetti.delete');

    //AJAX
    Route::get('/ajaxNomeAereo', [AuthController::class, 'ajaxNomeAereo']);
    Route::get('/ajaxCheckAirportCode', [AuthController::class, 'ajaxCheckAirportCode']);
    Route::get('/ajaxNomeCompagnia', [AuthController::class, 'ajaxNomeCompagnia']);

    //VISUALIZZAZIONE ELENCO UTENTE
    Route::get('/admin/addettiVoli', [AddettiController::class, 'indexVoli'])->name('addetti.indexVoli');
    Route::get('/admin/addettiPrenotazioni', [AddettiController::class, 'indexPrenotazioni'])->name('addetti.indexPrenotazioni');
    Route::get('/admin/clienti', [AddettiController::class, 'clienti'])->name('addetti.clienti');

});



Route::fallback(function () {
    return view('errors.404')->with('message', 'Errore 404 - Pagina non trovata!');
})->middleware('lang');




