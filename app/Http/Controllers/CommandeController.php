<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\commandeitem;
use Illuminate\Support\Facades\Validator;

use DB;






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
        $data = Commande::with('commandeitem')->get();
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
            'commands' => 'required',
            ];
       
        $validator = Validator::make($request->all(), $rules);


        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()],400);
        }


        $data = collect($request->commands);

        
        $commande = Commande::create([
            'user_id' => Auth::user()->id,
        ]);


        $data = $data->map(function ($item) use($commande) {
            $nitem = $item;
            $nitem['commande_id'] = $commande->id;
            return $nitem;
        });



        $commandeitem = commandeitem::insert($data->toArray());

        




        // foreach ($data->toArray() as $item) { 
        // $product = Product::where('id', $item['id'])->first();
           
        // if (!$product) {
        //     return response([
        //         'message' => "{$item['id']} not found"
        //     ], 404);
                  
        // }



        // $commandeitem =  commandeitem::create([

        //     'quantite' => $item['quantite'],
        //     'commande_id' => $commande->id,
        //     'product_id' => $item['id']


        // ]);

    



        

            
        // }

        return response(Commande::with('commandeitem.commande')->where('id',$commande->id)->get(), 201);
      
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
