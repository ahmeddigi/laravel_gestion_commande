<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'user_id', 
    ];




    /**
     * Get the product associated with the Commande
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */


     /**
      * Get the user that owns the Commande
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */

    

    /**
     * Get the user that owns the Commande
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

     /**
      * The roles that belong to the Commande
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
      */

      
    public function product()
    {


        return $this->belongsToMany(
            Product::class,
            'commandeproducts',
            'commande_id',
            'product_id');



       
    }
  
    



 


    /**
     * Get the user that owns the Commande
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }




}
