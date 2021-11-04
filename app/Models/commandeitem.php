<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commande;

use App\Models\Product;




class commandeitem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',    
        'commande_id',
        'product_id'
    ];




   public function product()
   {
       return $this->belongsTo(Product::class,'commande_id','id');
   }
}
