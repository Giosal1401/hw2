<?php

use Illuminate\Database\Eloquent\Model;

class InfoOrdine extends Model
{
    protected $table = 'info_ordini';

    protected $fillable =[
        'ordine_id',
        'prodotto_id',
        'quantity'
    ];

    public $timestamps = false;
  
    public function prodotto(){
        return $this->belongsTo('Prodotto');
    }

    public function ordine(){
        return $this->belongsTo('Ordine');
    }

}

?>
