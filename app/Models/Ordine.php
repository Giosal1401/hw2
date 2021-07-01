<?php

use Illuminate\Database\Eloquent\Model;

class Ordine extends Model
{
    protected $table = 'ordini';

    protected $fillable = [
        'user_id'
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo('User');
    }
    
    public function info_ordine(){
        return $this->belongsToMany('Prodotto','info_ordini')->withPivot('quantity');
    }

}

?>