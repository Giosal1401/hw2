<?php


use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Exceptions;

class CarrelloController extends BaseController
{
    public function index(){
        if(session('user_id') != null){
            $user = User::find(session('user_id'));
            return view('carrello')
                ->with('user', $user);
        }else{
            return view('carrello');
        }
    }   
    
    public function addToCart(){
        //return request();
        if(session('user_id') != null){
            $user = User::find(session('user_id'));
            if(request() == null){
                return ["response" => "Errore, dati post nulli!"];
            }
            $request = request();

            if(strcmp($request->operazione,"add") == 0){
                
                if(strcmp($request->quantità,"") == 0){
                    return[
                        "response" => "Operazione non consentita!",
                        "message_user" => "Inserire la quantità"
                    ];
                }
                if(intval($request->quantità) <= 0){
                    return[
                        "response" => "Operazione non consentita!",
                        "message_user" => "Inserire una quantità positiva"
                    ];
                }

                $old_prodotto = Carrello::where('prodotto_id', $request->id_prodotto)->where('user_id',$user->id)->first();
                //return $old_prodotto;

                if($old_prodotto != null){
                    $old_prodotto->quantity += $request->quantità;
                    $old_prodotto->save();
                }else{
                    Carrello::create([
                        'user_id' => $user->id,
                        'prodotto_id' => $request->id_prodotto,
                        'quantity' => $request->quantità
                   ]);
                }

                return[
                    "response" => "Operazione andata a buon fine!",
                    "message_user" => "Elemento inserito nel carrello!"
                ];
            }else if(strcmp($request->operazione,"remove") == 0){
                $old_prodotto = Carrello::where('prodotto_id', $request->id_prodotto)->where('user_id',$user->id)->first();
                if($old_prodotto != null){
                    if($old_prodotto->quantity == 1){
                        $old_prodotto->delete();
                    }else{
                        $old_prodotto->quantity = $old_prodotto->quantity - $request->quantità;
                        $old_prodotto->save();
                    }

                    return ["response" => "Operazione andata a buon fine!"];
                }else{
                   return ["response" => "Operazione non consentita, oggetto non presente nel database!"]; 
                }

            }else if(strcmp($request->operazione,"delete") == 0){
                $old_prodotto = Carrello::where('prodotto_id', $request->id_prodotto)->where('user_id',$user->id)->first();

                if($old_prodotto != null){
                    $old_prodotto->delete();
                    return ["response" => "Operazione andata a buon fine!"]; 
                }else{
                    return ["response" => "Errore, oggetto non presente nel database!"];
                }
            }
        }else{
            return ["response" => "Operazione non consentita, non autenticato!"];
        }
    }

    public function numeroProdottiCarrello(){
        if(session('user_id') != null){
            $user = User::find(session('user_id'));
            return[
                "response" => "Operazione andata a buon fine!",
                "numero_prodotti" => $user->nprodotticarrello
            ];
        }else{
            return ["response" => "Operazione non consentita, non autenticato!"];
        }
    }

    public function checkoutCart(){
        if(session('user_id') != null){
            $user = User::find(session('user_id'));
            $carrello = Carrello::where('user_id',$user->id)->get();
            
            if(/*$carrello != null || */count($carrello) != 0){
                $ordine = Ordine::create([
                    'user_id' => $user->id
                ]);
                
                for($i = 0; $i < count($carrello); $i++){
                    InfoOrdine::create([
                        'ordine_id' => $ordine->id,
                        'prodotto_id' => $carrello[$i]->prodotto_id,
                        'quantity' => $carrello[$i]->quantity
                    ]);
                }

                if($ordine->info_ordine != null || count($ordine->info_ordine) != 0){
                    for($i = 0; $i < count($carrello); $i++){
                        $carrello[$i]->delete();
                    }
                    return [
                        "response" => "Operazione andata a buon fine!",
                        "message_user" => "Acquisto andato a buon fine"
                    ];
                }else{
                    for($i = 0; $i < count($ordine->info_ordine); $i++){
                        $info = InfoOrdine::where('ordine_id',$ordine->id)->first();
                        $info->delete();
                    }
                    $ordine->delete();
                    return [
                        "response" => "Operazione non riuscita, errore interazione con il database",
                        "message_user" => "Acquisto fallito"
                    ];
                }
                
            }else{
                ["response" => "Operazione non consentita, non prodotto presente nel carrello!"];
            }
        
        }else{
            return ["response" => "Operazione non consentita, non autenticato!"];
        }        
    }
    
}

?>
