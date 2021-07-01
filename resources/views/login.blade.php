@extends('secondario')

@section('title','Login')

@push('styles')
<link rel="stylesheet" href="{{ url('styles/login.css') }}" />
@endpush

@push('scripts')
<script src="{{ url('scripts/login.js') }}" defer="true"></script>
@endpush

@section('link')
@parent
<a href="{{ route('account') }}">Account</a>
@endsection

@section('link_mobile')
@parent
<a href="{{ route('account') }}">Account</a>
@endsection

@section('content')
<h1>Accedi al tuo account</h1>

    <div class="errore">
        <p class="hidden">Compilare tutti i campi!</p>
        <p @if(count($errors) == 0) class="hidden" @endif>Nome utente o password errata!</p> 
        <!-- <p class="hidden">Nome utente o password errata!</p> -->
    </div>
    
    <main>
        <form name="autenticazione" method="post">
            <!-- @csrf -->
            <p>
                <label>Inserisci Email/Nome utente <input type="text" name="username" value="{{ $old_username }}"></label>
            </p>
            <p>
                <label>Inserisci Password <input type="password" name="password"></label>
            </p>
            <p>
                <label>&nbsp;<input type="submit" value="Accedi"></label>
                <input type="hidden" name="_token" value=<?php  echo csrf_token(); ?>>
            </p> 
        </form>
    </main>

    <div>
        <h3>Non sei iscritto?</h3>
        <a href="{{ route('register') }}">Clicca qui</a>
    </div>
@endsection