@extends('secondario')

@section('title','Registazione')

@push('styles')
<link rel="stylesheet" href="{{ url('styles/registrazione.css') }}" />
@endpush

@push('scripts')
<script src="{{ url('scripts/register.js') }}" defer="true"></script>
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
    <h1>Registrati</h1>
    <ul>
        <li>Il nome utente deve contenere almeno 5 caratteri</li>
        <li>La password deve essere lunga almeno 6 caratteri di cui almeno 1 carattere maiuscolo e 1 numero</li>
    </ul>

    <div class="errore">
        <p class="hidden">Compilare tutti i campi!</p>
        <p class="hidden">Username non valido!</p>
        <p class="hidden">Email non valida!</p>
        <p class="hidden">Password non valida!</p>
        @if(count($errors) > 0) 
        <p> 
        @foreach($errors->all() as $error) 
        {{ $error }} 
        <br> 
        @endforeach
        </p> 
        @endif
    </div>

    <main>
        <form name="registrazione" method="post">
            @csrf
            <p>
                <label>Inserisci Nome utente <input type="text" name="username"></label>
            </p>
            <p>
                <label>Inserisci Email<input type="text" name="email"></label>
            </p>
            <p>
                <label>Inserisci Password <input type="password" name="password"></label>
            </p>
            <p>
                <label>&nbsp;<input type="submit" value="Registrati"></label>
                <!-- <input type="hidden" name="_token" value=<?php csrf_token(); ?> > -->
            </p>
        </form>
    </main>

    <div>
        <h3>Sei già iscritto?</h3>
        <a href="{{ route('login') }}">Accedi qui</a>
    </div>

@endsection