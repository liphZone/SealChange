<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateFormRequest;
use App\Models\Coin;
use App\Models\Rate;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rate = Rate::simplePaginate(15);
        return view('rates.list_rates',compact('rate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coin = Coin::orderBy('libelle','asc')->get();
        return view('rates.add_rate',compact('coin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RateFormRequest $request)
    {
        $insertion = Rate::firstOrCreate([
            'monnaie_enter' => strtolower($request->monnaie_enter),
            'monnaie_out'   => strtolower( $request->monnaie_out),
        ],
        [
            'devise_enter'  => $request->devise_enter,
            'devise_out'    => $request->devise_out,
            'valeur_enter' => $request->valeur_enter,
            'valeur_out'   => $request->valeur_out,

        ]);

        if ($insertion) {
            Flashy::success('Enregistrement réussi');
            return back();
        }else{
            Flashy::error('Echec');
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
        $rate = Rate::findOrFail($id);
        return view('rates.edit_rate',compact('rate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RateFormRequest $request, $id)
    {
        $rate = Rate::findOrFail($id);

        $update = $rate->update([
            'monnaie_enter' => strtolower($request->monnaie_enter),
            'monnaie_enter' => strtolower($request->monnaie_enter),
            'monnaie_out'   => strtolower( $request->monnaie_out),
            'devise_enter'  => $request->devise_enter,
            'devise_out'    => $request->devise_out,
            'valeur_enter'  => $request->valeur_enter,
            'valeur_out'    => $request->valeur_out,
        ]);
        if ($update) {
           Flashy::success('Modification réussie');
           return redirect()->route('list_rates');
        }else{
            Flashy::error("Echec de modification !");
            return back();
        }
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
