<?php

use Illuminate\Routing\Controller as BaseController;


class HomeController extends BaseController
{

    public function index(){
        if(session('user_id') != null){
            $user = User::find(session('user_id'));

            return view('home')
                ->with('user', $user->username)
                ->with('prodotti_carrello', $user->nprodotticarrello);
        }else{
            return view('home');
        }
    }

    public function jsonProdotti(){
        $prodotti = Prodotto::all();
        return $prodotti;
    }

    public function prodottiMaxVendite(){
        $media =  ViewProdotti::selectRaw('avg(n_acquistati) as media')->get()[0]->media;
        $view =  ViewProdotti::where('n_acquistati','>', $media)->get();
        $array_id = array();
        for($i = 0; $i < count($view); $i++){
            $array_id[] = $view[$i]->id;
        }
        return Prodotto::whereIn('id',$array_id)->get();
    }


}

?>