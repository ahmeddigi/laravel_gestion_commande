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





    /**
     * Get all of the comments for the commandeitem
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   /**
    * The commande that belong to the commandeitem
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function commande()
   {
       return $this->belongsToMany(Commande::class);
   }


   /**
    * Get all of the products for the commandeitem
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function products()
   {
       return $this->belongsToMany(Product::class);
   }
}
