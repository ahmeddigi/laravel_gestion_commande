<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Commandeitem;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CommandeResource;
use App\Http\Resources\CommandeitemResource;
use Illuminate\Support\Facades\Gate;

use DB;






class CommandeController extends Controller
{

    public function index()
    {
        $data = Commande::with('commandeitems.product')->where('user_id',auth::user()->id)->get();
        return CommandeResource::collection($data);
    }


    public function store(Request $request)

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



       Commandeitem::insert($data->toArray());

        

        return response(CommandeResource::collection(Commande::with('commandeitems.product')->where('id',$commande->id)->get()), 201);
      
    }

  
    public function show($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {


        $rules = [ 
            'quantite' => 'required|int',
        ];
       
        $validator = Validator::make($request->all(), $rules);


        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()],400);
        }

        if (Gate::allows('update',Commande::find($id)))
        {
         $command = Commandeitem::where('commande_id',$id)->update(['quantite'=>$request->quantite]);   
         return response(
            CommandeitemResource::collection(Commandeitem::where('commande_id',$id)->get())
        , 201);
         
        }
        else{
            return response([
                'message' => 'Not Authorized'
            ], 401);
        }
        
    }

    
    public function destroy($id)
    {
        //
    }
}
