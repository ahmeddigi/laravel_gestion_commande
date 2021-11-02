<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commande;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'pname',
    ];



      
    public function commande()
    {

        return $this->belongsToMany(
            Commande::class,
            'commandeproducts',
            'product_id',
            'commande_id',);


    }







    


}
