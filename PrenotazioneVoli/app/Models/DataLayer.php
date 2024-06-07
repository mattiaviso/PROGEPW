<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Aereoporti;
use App\Models\Voli;
use App\Models\Aerei;
use App\Models\Compagnie;
use App\Models\Prenotazioni;
use App\Models\Passeggeri;
use App\Models\Clienti;

use Illuminate\Support\Facades\Hash;




class DataLayer extends Model
{
    public function listAirport()
    {
        $books = Aereoporti::orderBy('nome', 'asc')->get();
        return $books;
    }

    public function listVoli()
    {
        $voli = Voli::orderBy('numeroVolo', 'asc')->get();
        return $voli;
    }

    public function findFlightByID($id)
    {
        $volo = Voli::find($id);
        return $volo;
    }

    public function listPrenotazioniById($id)
    {
        $prenotazioni = Prenotazioni::where('cliente_id', $id)->orderBy('dataPrenotazione', 'asc')->get();
        return $prenotazioni;
    }

    public function cercaVoliPerCity($city)
    {
        $voli = Voli::whereHas('aereoportoArrivo', function ($query) use ($city) {
            $query->where('city', $city);
        })->get();
        return $voli;
    }


    public function listAirportPartenza()
    {
        //ritorna lista aereoporti da cui è in partenza un volo
        $aeroporti = Aereoporti::whereHas('voliPartenza', function ($query) {
            $query->where('id', '>', 0);
        })->get();
        return $aeroporti;
    }

    public function listAirportArrivo()
    {
        //ritorna lista aereoporti da cui è in partenza un volo
        $aeroporti = Aereoporti::whereHas('voliArrivo', function ($query) {
            $query->where('id', '>', 0);
        })->get();
        return $aeroporti;
    }
    public function listAirportInCity($city)
    {
        //ritorna lista aereoporti nella citta city
        $aeroporti = Aereoporti::where('city', $city)->get();
        return $aeroporti;

    }

    public function findAirportById($id)
    {
        $airport = Aereoporti::find($id);
        return $airport;
    }



    public function listAerei()
    {
        $aerei = Aerei::orderBy('id', 'asc')->get();
        return $aerei;
    }


    //prima si chiamava getAereo

    public function findAereoById($id)
    {
        $aereo = Aerei::find($id);
        return $aereo;
    }

    public function deleteAereo($id)
    {
        $aereo = Aerei::find($id);
        $aereo->delete();
    }





    public function listCompagnie()
    {
        $compagnie = Compagnie::orderBy('id', 'asc')->get();
        return $compagnie;
    }

    public function findCompagniaById($id)
    {
        $compagnia = Compagnie::find($id);
        return $compagnia;
    }

    public function addCompagnia($nome, $sede, $country, $anno_fondazione)
    {
        $compagnia = new Compagnie;
        $compagnia->nome = $nome;
        $compagnia->sede = $sede;
        $compagnia->country = $country;
        $compagnia->anno_fondazione = $anno_fondazione;
        $compagnia->save();
    }

    public function editCompagnia($id, $nome, $sede, $country, $anno_fondazione)
    {
        $compagnia = Compagnie::find($id);
        $compagnia->nome = $nome;
        $compagnia->sede = $sede;
        $compagnia->country = $country;
        $compagnia->anno_fondazione = $anno_fondazione;
        $compagnia->save();
    }

    public function deleteCompagnia($id)
    {
        $compagnia = Compagnie::find($id);
        $compagnia->delete();
    }

    public function addVolo($numeroVolo, $aereo_id, $compagnia_id, $aereoporto_partenza_id, $aereoporto_arrivo_id, $orario_partenza, $orario_arrivo)
    {
        $volo = new Voli;

        $volo->numeroVolo = $numeroVolo;
        $volo->aereo_id = $aereo_id;
        $volo->compagnia_id = $compagnia_id;
        $volo->aereoportoPartenza_id = $aereoporto_partenza_id;
        $volo->aereoportoArrivo_id = $aereoporto_arrivo_id;
        $volo->orarioPartenza = $orario_partenza;
        $volo->orarioArrivo = $orario_arrivo;

        $volo->save();
    }

    public function editVolo($id, $numeroVolo, $aereo_id, $compagnia_id, $aereoporto_partenza_id, $aereoporto_arrivo_id, $orario_partenza, $orario_arrivo)
    {
        $volo = Voli::find($id);

        $volo->numeroVolo = $numeroVolo;
        $volo->aereo_id = $aereo_id;
        $volo->compagnia_id = $compagnia_id;
        $volo->aereoportoPartenza_id = $aereoporto_partenza_id;
        $volo->aereoportoArrivo_id = $aereoporto_arrivo_id;
        $volo->orarioPartenza = $orario_partenza;
        $volo->orarioArrivo = $orario_arrivo;
        $volo->save();
    }

    public function editAirport($id, $nome, $city, $country, $code, $lat, $lon)
    {
        $airport = Aereoporti::find($id);
        $airport->nome = $nome;
        $airport->city = $city;
        $airport->country = $country;
        $airport->codice_iata = $code;
        $airport->lat = $lat;
        $airport->lon = $lon;
        $airport->save();
    }

    public function addAirport($nome, $city, $country, $code, $lat, $lon)
    {
        $airport = new Aereoporti;

        $airport->nome = $nome;
        $airport->city = $city;
        $airport->country = $country;
        $airport->codice_iata = $code;
        $airport->lat = $lat;
        $airport->lon = $lon;
        $airport->save();
    }

    public function deleteAirport($id)
    {
        $airport = Aereoporti::find($id);
        $airport->delete();
    }

    public function addPrenotazione($volo_id, $utente_id, $data)
    {

        $prenotazione = new Prenotazioni;

        $prenotazione->volo_id = $volo_id;
        $prenotazione->cliente_id = $utente_id;
        $prenotazione->dataPrenotazione = $data;
        $prenotazione->save();

        return $prenotazione->id;

    }

    public function addPasseggero($nome, $cognome)
    {
        $passeggero = new Passeggeri;
        $passeggero->nome = $nome;
        $passeggero->cognome = $cognome;
        $passeggero->save();

        return $passeggero->id;
    }



    public function detachAllPassangerInPrenotazione($id_prenotazione)
    {
        $prenotazione = Prenotazioni::find($id_prenotazione);
        $passeggeri_prenotazione = $prenotazione->passeggeri;
        foreach ($passeggeri_prenotazione as $p) {
            $prenotazione->passeggeri()->detach($p->id);
        }
    }


    public function getClienteById($id)
    {
        $cliente = Clienti::find($id);
        return $cliente;
    }

    public function findPasseggero($nome, $cognome)
    {
        $passeggero = Passeggeri::where('nome', $nome)->where('cognome', $cognome)->get();
        if (count($passeggero) == 0) {
            return null;
        } else {
            return $passeggero[0]->id;
        }
    }

    public function addAereo($nome, $posti)
    {
        $aereo = new Aerei;
        $aereo->nomeModello = $nome;
        $aereo->capacita = $posti;
        $aereo->save();
    }

    public function findCompagniaByUserID($id)
    {
        $compagnia = Clienti::find($id)->compagnia_id;
        return $compagnia;
    }

    public function listVoliByCompagniaId($compagnia_id)
    {
        $voli = Voli::where('compagnia_id', $compagnia_id)->orderBy('numeroVolo', 'asc')->get();
        return $voli;
    }

    public function deletePrenotazione($id)
    {
        $prenotazione = Prenotazioni::find($id);
        $passeggeri_prenotazione = $prenotazione->passeggeri;
        foreach ($passeggeri_prenotazione as $p) {
            $prenotazione->passeggeri()->detach($p->id);
        }
        $prenotazione->delete();
    }


    public function addAddetti($nome, $cognome, $dataNascita, $luogoNascita, $email, $password, $compagnia_id, $ruolo)
    {
        $addetto = new Clienti();
        $addetto->nome = $nome;
        $addetto->cognome = $cognome;
        $addetto->dataNascita = $dataNascita;
        $addetto->luogoNascita = $luogoNascita;
        $addetto->email = $email;
        $addetto->password = Hash::make($password);
        $addetto->compagnia_id = $compagnia_id;
        $addetto->ruolo = $ruolo;
        $addetto->save();
    }

    public function findPrenotazioneByID($id)
    {
        $prenotazione = Prenotazioni::find($id);
        return $prenotazione;
    }

    public function addPrenotationPasseggero($id_prenotazione, $id_Pass)
    {
        $prenotazione = Prenotazioni::find($id_prenotazione);
        $passeggero = Passeggeri::find($id_Pass);
        $prenotazione->passeggeri()->attach($passeggero->id);
    }

    public function listPrenotazioni()
    {
        $prenotazioni = Prenotazioni::orderBy('id', 'asc')->get();
        return $prenotazioni;
    }

    public function deleteVolo($id)
    {
        $volo = Voli::find($id);
        $volo->delete();
    }

    public function listaAddettiVoli()
    {
        //ritorna clienti con ruolo == inserimento order by nome e cognome
        $utenti = Clienti::where('ruolo', 'inserimento')->orderBy('nome', 'asc')->orderBy('cognome', 'asc')->get();
        return $utenti;
    }

    public function listaAddettiPrenotazioni()
    {
        $utenti = Clienti::where('ruolo', 'prenotazioni')->orderBy('nome', 'asc')->orderBy('cognome', 'asc')->get();
        return $utenti;
    }

    public function findAddettoById($id)
    {
        $addetto = Clienti::find($id);
        return $addetto;
    }

    public function updateAddetti($id, $nome, $cognome, $dataNascita, $luogoNascita, $email, $password, $compagnia_id, $ruolo)
    {
        $addetto = Clienti::find($id);
        $addetto->nome = $nome;
        $addetto->cognome = $cognome;
        $addetto->dataNascita = $dataNascita;
        $addetto->luogoNascita = $luogoNascita;
        $addetto->email = $email;
        $addetto->password = Hash::make($password);
        $addetto->compagnia_id = $compagnia_id;
        $addetto->ruolo = $ruolo;
        $addetto->save();
    }

    public function addCliente($nome, $cognome, $dataNascita, $luogoNascita, $email, $password)
    {
        $cliente = new Clienti();
        $cliente->nome = $nome;
        $cliente->cognome = $cognome;
        $cliente->dataNascita = $dataNascita;
        $cliente->luogoNascita = $luogoNascita;
        $cliente->email = $email;
        $cliente->password = Hash::make($password);
        $cliente->ruolo = "cliente";
        $cliente->save();
    }

    public function validUser($email, $password)
    {
        $user = Clienti::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserID($email)
    {
        $users = Clienti::where('email', $email)->get(['id']);
        return $users[0]->id;
    }

    public function getUserName($email)
    {
        $users = Clienti::where('email', $email)->get(['nome']);
        return $users[0]->nome;
    }

    public function getUserRole($email)
    {
        $users = Clienti::where('email', $email)->get(['ruolo']);
        return $users[0]->ruolo;
    }

    public function findUserByemail($email)
    {
        $users = Clienti::where('email', $email)->get();

        if (count($users) == 0) {
            return false;
        } else {
            return true;
        }
    }


}
