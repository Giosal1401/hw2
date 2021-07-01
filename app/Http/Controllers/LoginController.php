<?php

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class LoginController extends BaseController
{

    public function index(){
        if(session('user_id') != null){
            return redirect('home');
        }else{
            $old_username = Request::old('username');
            return view('login')
                ->with('csrf_token', csrf_token())
                ->with('old_username', $old_username);
        }
    }

    public function checkLogin(){
        $searchField = filter_var(request('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = User::where($searchField, request('username'))->first();
        if(isset($user)){
            if(Hash::check(request('password'),$user->password)){
                Session::put('user_id',$user->id);
                return redirect('home');
            }else{
                return redirect('login')
                    ->withErrors(['utente_non_verificato'])
                    ->withInput();
            }

        }else{
            return redirect('login')
                ->withErrors(['utente_non_verificato'])
                ->withInput();
        }
    }

    public function logout(){
        Session::flush();
        return redirect('login');
    }
}

?>