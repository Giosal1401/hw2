<?php

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $hidden = ['password'];

    protected $fillable = [
        'username',
        'email',
        'password'
    ];

    public $timestamps = false;

    public function prodottiCarrello(){
        return $this->belongsToMany('Prodotto','carrello')->withPivot('quantity');
    }

    public function prodottiPreferiti(){
        return $this->belongsToMany('Prodotto','preferiti');
    }

    public function ordini(){
        return $this->hasMany('Ordine');
    }
}

?>