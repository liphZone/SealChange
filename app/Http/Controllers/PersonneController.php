<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Personne;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PersonneFormRequest;
use App\Http\Requests\InscriptionFormRequest;
use Illuminate\Support\Facades\Http;

class PersonneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Liste des administrateurs
        $personne = DB::table('personnes')
        ->where('type_utilisateur','Super_admin')
        ->Orwhere('type_utilisateur','Admin')
        ->join('users','personnes.id','=','users.personne_id')
        ->get();
        return view('personnes.list_persons',compact('personne'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personnes.add_person');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InscriptionFormRequest $i,PersonneFormRequest $p)
    {
        $personne = Personne::firstOrCreate([
            'nom'    => $p->nom,
            'prenom' => $p->prenom,
            'email'  => $p->email,
        ]);

        $user = User::firstOrCreate([
            'email'            => $personne->email,
            'password'         => bcrypt($p->password),
            'token'            => str_random(60),
            'type_utilisateur' => 'Admin'
        ],
        [
            'personne_id' => $personne->id,
        ]);

        if ($personne AND $user) {
            Flashy::success('Inscription réussie');
            return redirect()->route('form_confirm_account');;
        } else {
            Flashy::error("Echec d'inscription");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
