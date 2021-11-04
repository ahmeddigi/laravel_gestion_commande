<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\commandeitem;



class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantite',
        'user_id', 
    ];

    /**
     * Get all of the comments for the Commande
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commandeitems()
    {
        return $this->hasMany(commandeitem::class);
    }


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }




}
