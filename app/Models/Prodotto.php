<?php

use Illuminate\Database\Eloquent\Model;

class Prodotto extends Model
{
    protected $table = 'prodotti';

    public $timestamps = false;

    public function info_ordine(){
        return $this->belongsToMany('Ordine','info_ordini')->withPivot('quantity');
    }

    public function user_preferiti(){
        return $this->belongsToMany('User','preferiti');
    }

    public function user_carrello(){
        return $this->belongsToMany('User','carrello')->withPivot('quantity');
    }


}

?>
