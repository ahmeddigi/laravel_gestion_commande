<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\commandeproduct;
use Illuminate\Support\Facades\Validator;






class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getcommands()
    {
        //
        $data = Commande::with('product')->get();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createcommande(Request $request)

    {


        $rules = [ 
            'id' => 'required|Integer',
            'quantitie' => 'required|Integer',
            ];
       
        $validator = Validator::make($request->all(), $rules);


        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()],400);
        }


        $product = Product::where('id', $request->id)->first();

        if (!$product) {
            return response([
                'message' => 'Product not found'
            ], 404);
        }


        $commande = Commande::create([
            'quantite' => $request->quantitie,
            'user_id' => Auth::user()->id,
        ]);


        $commande->product()->attach($product->id);













        return response($commande, 201);















      
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
