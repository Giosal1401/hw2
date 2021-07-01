<?php

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class RegisterController extends BaseController
{
    public function index(){
        if(session('user_id') != null){
            $user = User::find(session('user_id'));
            return redirect('home');
        }else{
            return view('register');
        }
    }

    public function checkUsername($query){
        $exist = User::where('username', $query)->exists();
        return ['exist' => $exist];
    }

    public function checkEmail($query){
        $exist = User::where('email', $query)->exists();
        return ['exist' => $exist];
    }

    public function createUser(){
        $request = request();
        if($request != null){
            $response_username = RegisterController::checkUsername($request->username);
            $response_email = RegisterController::checkEmail($request->email);
            
            if($response_username['exist']  == false && $response_email['exist']  == false){
                $user = User::create([
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
                Session::put('user_id',$user->id);
                return redirect('home');
                //return ['response' => 'Operazione andata a buon fine!'];
            }

            if($response_username['exist']  == true || $response_email['exist']  == true){
                if($response_username['exist']  == true && $response_email['exist']  == false){
                    return redirect('register')
                        ->withErrors(['Nome utente già in uso!']);
                        //->with('old_email',$request->email);
                }else if($response_username['exist']  == false && $response_email['exist']  == true){
                    return redirect('register')
                        ->withErrors(['Email già associata ad un account!']);
                        //->with('old_username',$request->username);
                }else{
                    return redirect('register')
                        ->withErrors(['Nome utente già in uso!','Email già associata ad un account!']);
                }
            }
            
        }else{
            return ['Response' => 'Operazione non consentita, dati post null'];
        }
        
    }
    
}

?>
