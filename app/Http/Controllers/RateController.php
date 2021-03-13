<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateFormRequest;
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
        $rate = Rate::all();
        return view('rates.list_rates',compact('rate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rates.add_rate');
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
            'monnaie_send'    => $request->monnaie_send,
            'monnaie_receive' => $request->monnaie_receive,
        ],
        [
            'valeur'          => $request->valeur,
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
            'monnaie_send'    => $request->monnaie_send,
            'monnaie_receive' => $request->monnaie_receive,
            'valeur'          => $request->valeur,
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
