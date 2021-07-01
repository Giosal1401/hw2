<?php

use Illuminate\Routing\Controller as BaseController;


class NovitaController extends BaseController
{

    public function index(){
       return view('novita');
    }

    //prodotti n_acquisto > media
    public function prodottiMaxVendite(){
        $media =  ViewProdotti::selectRaw('avg(n_acquistati) as media')->get()[0]->media;
        $view =  ViewProdotti::where('n_acquistati','>', $media)->get();
        $array_id = array();
        for($i = 0; $i < count($view); $i++){
            $array_id[] = $view[$i]->id;
        }
        return Prodotto::whereIn('id',$array_id)->get();
    }


    // i primi 6 prodotti venduti maggiormente
    public function prodottiMaxVendite2(){
        $view =  ViewProdotti::orderBy('n_acquistati','desc')->limit(6)->get();
        if(count($view) == 0){
            $prodotti = array();
            for($i =  1; $i <= 11; $i+=2){
                $prodotti[] = Prodotto::where('id',$i)->first();
            }
            return $prodotti;
        }
        $array_id = array();
        for($i = 0; $i < count($view); $i++){
            $array_id[] = $view[$i]->id;
        }
        return Prodotto::whereIn('id',$array_id)->get();
    }

    public function ricercaProdotti(){
        $request = request();
        if(strcmp($request->price,"60+") == 0){
            return Prodotto::where('tipo',$request->prodotto)->where('prezzo','>',60)->get();
        }else{
            if(strncmp($request->price,"0",1) == 0){
                return Prodotto::where('tipo',$request->prodotto)->where('prezzo','<',20)->get();
            }else{
                return Prodotto::where('tipo',$request->prodotto)
                    ->where('prezzo','>',substr($request->price,0,2))
                    ->where('prezzo','<',substr($request->price,3,2))->get();
            }  
        }
    }


}

?>