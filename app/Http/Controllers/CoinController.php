<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Type;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;
use App\Http\Requests\CoinFormRequest;
use Illuminate\Support\Facades\Storage;

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coin = Coin::all();
        return view('coins.list_coins',compact('coin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = Type::all();
        return view('coins.add_coin',compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoinFormRequest $c)
    {

        $name = auth()->user()->id;
        $image = $c->file('image');
        $image_name = time().'.'.$image->extension();
        $image->move(public_path('Zone'),$image_name);


        //Récuperation de l'image
        // $image = $c->file('image');
        // $random  = str_random(3);

        // //Nommmer l'image 
        // $image_name = auth()->user()->id. $random . $image->getExtension();

        // //Deplacer l'image dans le dossier public
        // $image->move(public_path('Zone'),$image_name);

        $insertion = Coin::firstOrCreate([
            'libelle'     => ucfirst($c->libelle),
            'description' => $c->description,
            'image'       => $image_name,
            'type_id'     => $c->type_id,
        ]);

        if ($insertion) {
            Flashy::success('Vous avez ajouté une nouvelle monnaie');
            return back();
        } else {
            Flashy::error("Echec d'ajout");
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
        $coin = Coin::findOrFail($id);
        $type = Type::all();
        return view('coins.edit_coin',compact('coin','type'));
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
        $name = auth()->user()->id;
        $image = $request->file('image');
        $image_name = time().'.'.$image->extension();
        $image->move(public_path('Zone'),$image_name);

        $coin = Coin::findOrFail($id);
        $update = $coin->update([
            'libelle'     => ucfirst($request->libelle),
            'description' => $request->description,
            'image'       => $image_name,
            'type_id'     => $request->type_id,
        ]);
        if ($update) {
           Flashy::success('Modification réussie');
           return redirect()->route('list_coins');
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
