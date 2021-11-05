<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Commandeitem;

class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'pname',
    ];


    // public function commande()
    // {
    //     return $this->ha(commandeitem::class);
    // }


    /**
     * Get all of the comments for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commandeitems()
    {
        return $this->hasMany(Commandeitem::class);
    }





    


}
