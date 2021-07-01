<?php

use Illuminate\Database\Eloquent\Model;

class ProdottoPreferito extends Model
{
    protected $table = 'preferiti';

    protected $fillable = [
        'user_id',
        'prodotto_id'
    ];

    public $timestamps = false;

    public function user(){
        return $this->belongsTo('User');
    }
    
    public function prodotto(){
        return $this->belongsTo('Prodotto');
    }
}

?>