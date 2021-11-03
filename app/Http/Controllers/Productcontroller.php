<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use DB;




class Productcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getproducts()
    {
        

        

        $data = DB::table('products')->get();


        return response()->json($data, 200);

        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createproduct(Request $request)
    {

       
        $validator = Validator::make($request->all(), [
            'pname' => 'required|string',
        ]);

        if($validator->fails()) {
            return response()->json(['success'=> false, 'error'=> $validator->messages()],400);
        }


        if (User::with('role')->where('id', Auth::user()->id)
        ->first()->role->code == 'ADMIN') {
            $product = Product::create([
                'pname' => $request->pname,
            ]);
            return response($product, 201);
        }
        else{
            return response([
                'message' => 'only admin can Add product'
            ], 401);
        }
    }

   
}
