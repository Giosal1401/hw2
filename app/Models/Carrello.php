<?php

use Illuminate\Database\Eloquent\Model;

class Carrello extends Model
{
    protected $table = 'carrello';

    protected $fillable =[
        'user_id',
        'prodotto_id',
        'quantity'
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
