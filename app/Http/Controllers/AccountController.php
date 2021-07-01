<?php


use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;


class AccountController extends BaseController
{

    public function index(){
        if(session('user_id') != null){
            $user = User::find(session('user_id'));
            return view('account')
                ->with('user', $user);
        }else{
            return view('account');
        }
    }

    public function auth(){
        if(session('user_id') != null){
            return ['Auth' => true];
        }else{
            return ['Auth' => false];
        }
    }

    public function jsonProdottiPreferiti(){
        if(session('user_id') != null){
            $user = User::find(session('user_id'));
            $preferiti = $user->prodottiPreferiti;
            
            return $preferiti;
        }else{
           return [];
        }
    }

    public function jsonProdottiCarrello(){
        if(session('user_id') != null){
            $user = User::find(session('user_id'));
            $carrello = $user->prodottiCarrello;
            
            return $carrello;
        }else{
           return [];
        }
    }

    public function add_remove_preferiti($action,$product){
        if(session('user_id') != null){
            $user = User::find(session('user_id'));
            //$exist = ProdottoPreferito::where('user_id',$user->id)->where('prodotto_id', $product)->exists();
            if(strcmp($action,"add") == 0){
                $exist = $user->prodottiPreferiti()->where('prodotto_id',$product)->exists();
                if($exist == 1){ 
                    return ["response" => "Operazione non consentita, oggetto presente nel database!"]; 
                }else{
                   $new_preferito = ProdottoPreferito::create([
                        'user_id' => $user->id,
                        'prodotto_id' => $product
                   ]);
                   //$new_preferito->save();
                   return ["response" => "Operazione andata a buon fine!"]; 
                }
            }else if(strcmp($action,"remove") == 0){
                $old_preferito = ProdottoPreferito::where('prodotto_id',$product)->where('user_id',$user->id)->first();
                if($old_preferito != null){
                    $old_preferito->delete();
                    return ["response" => "Operazione andata a buon fine!"]; 
                }else{
                    return ["response" => "Errore, oggetto non presente nel database!"]; 
                }
            }
        }else{
            return ["response" => "Operazione non consentita, non autenticato!"];
        }
    }

    public function jsonOrdini(){
        if(session('user_id') != null){
            $user = User::find(session('user_id'));
            $ordini = $user->ordini;
            $res = array();

            //Mi è sembrata la soluzione migliore tra tutte quelle elencate sotto
            $aux = 0;                           
            for($i = 0; $i < count($ordini); $i++){
                $info_ordine = $ordini[$i]->info_ordine;
                $res[$aux] = array();
                $res[$aux]['ordine'] = ['ordine' => $ordini[$i]->id];
                 
                for($j = 0; $j < count($info_ordine); $j++){
                    $res[$aux]['prodotti'][] = ['nome' => $info_ordine[$j]->nome, 'quantity' => $info_ordine[$j]->pivot->quantity];
                }
                $aux++;
            }
            return $res;

            /*for($i = 0; $i < count($ordini); $i++){ 
                $info_ordine = $ordini[$i]->info_ordine;
                $res[] = $info_ordine;
            }
            return $res;*/

            /*$aux = 0;
            for($i = 0; $i < count($ordini); $i++){
                $info_ordine = $ordini[$i]->info_ordine;
                $res[$aux] = array();
                $res[$aux][] = ['ordine' => $ordini[$i]->id];
                
                for($j = 0; $j < count($info_ordine); $j++){
                    $res[$aux][] = ['nome' => $info_ordine[$j]->nome, 'quantity' => $info_ordine[$j]->pivot->quantity];
                }
                $aux++;
            }
            return $res;*/

            /*$aux = 0;
            for($i = 0; $i < count($ordini); $i++){
                $info_ordine = $ordini[$i]->info_ordine;
                $res[$aux] = array();
                $res[$aux][1] = array();
                $res[$aux][0] = ['ordine' => $ordini[$i]->id];
                //return $info_ordine; 
                for($j = 0; $j < count($info_ordine); $j++){
                    $res[$aux][1][] = ['nome' => $info_ordine[$j]->nome, 'quantity' => $info_ordine[$j]->pivot->quantity];
                }
                $aux++;
            }
            return $res;*/
        }else{
            return[]; 
        }
    }

    public function changeDetails($campo){
        if(session('user_id') != null){
            $user = User::find(session('user_id'));
            $request = request();
            $errori = array();

            if($request == null){
                return ['response' => 'Operazione non consentita, dati post nulli'];
            }

            if($campo == 'email'){
                if (!filter_var($request->old_email, FILTER_VALIDATE_EMAIL)) {
                    $errori[] = "Email non valida";
                }else{
                    if($user->email != $request->old_email){
                        $errori[] = "Errore, non cambiare il campo email attuale!";
                    }
                }
    
                if(!filter_var($request->new_email, FILTER_VALIDATE_EMAIL)){
                    $errori[] = "Nuova email non valida";
                }else{
                    if(User::where('email',$request->new_email)->get() == null){
                        $errori[] = "Nuova email associata già ad un altro account!";
                    }
                }
    
                if(count($errori) == 0){
                    $user->email = $request->new_email;
                    $user->save();
                    return [
                        'response' => 'Operazione andata a buon fine!',
                        'message_user' => ['Email aggiornata!']
                    ];
                }else{
                    return [
                        'response' => 'Operazione non consentita!',
                        'message_user' => $errori
                    ];
                }
            }else if($campo == 'password'){
                if(strlen($request->new_password) < 6 || strcmp(strtolower($request->new_password),$request->new_password) == 0 || preg_match('/[0-9]/',$request->new_password) == 0){
                    $errori[] = "Nuova password non valida";
                }

                if(Hash::check($request->old_password,$user->password) == false){
                    $errori[] = "Errore, password non corretta!";
                }

                if(count($errori) == 0){
                    $user->password = Hash::make($request->new_password);
                    $user->save();
                    return [
                        'response' => 'Operazione andata a buon fine!',
                        'message_user' => ['Password aggiornata!']
                    ];
                }else{
                    return [
                        'response' => 'Operazione non consentita!',
                        'message_user' => $errori
                    ];
                }

            }
            
        }else{
            return ['response' => 'Operazione non consentita, utente non autenticato'];
        }
    }
    
}

?>
