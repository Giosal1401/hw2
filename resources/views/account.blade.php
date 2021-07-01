@extends('secondario')

@section('title','Account')

@push('styles')
<link rel="stylesheet" href="{{ url('styles/account.css') }}" />
@endpush

@push('scripts')
<script src="{{ url('scripts/account.js') }}" defer="true"></script>
@endpush

@section('link')
@parent
<a href="{{ route('carrello') }}">Carrello</a>
@endsection

@section('link_mobile')
@parent
<a href="{{ route('carrello') }}">Carrello</a>
@endsection

@section('content')
<div @if (!isset($user)) class="hidden" @endif>
    <h1>I dettagli del tuo account</h1>
    <table>
        <tr>
            <th>Username: </th>
            <td> @if (isset($user)) {{ $user->username }} @else null @endif </td>
        </tr>
        <tr>
            <th>Email: </th>
            <td> @if (isset($user)) {{ $user->email }} @else null @endif </td>
        </tr>
        <tr>
            <th>Password: </th>
            <td>*******</td>
        </tr>
    </table><br>
    <p>Vuoi cambiare email? <button id="email_button">Clicca qui</button></p>
    <p>Vuoi cambiare password? <button id="password_button">Clicca qui</button></p>
    <a href=" {{ route('logout') }}">Logout</a>
</div>

<div @if (isset($user)) class="hidden" @endif>
    <h1>Devi prima accedere al tuo account</h1>
    <p>Non sei iscritto?<a href="{{ route('register') }}">Registrati qui</a></p>
    <p>Sei già iscritto?<a href="{{ route('login') }}">Accedi</a></p>
</div>

<div @if (!isset($user)) class="hidden" @endif>
    <h1>I tuoi ordini</h1>
    <div class="grid" id="ordini"></div>
</div>
</section>

<section id="modal-view" class="hidden">
<div>
    <ul class="hidden">
        <li>La password deve essere lunga almeno 6 caratteri di cui almeno 1 carattere maiuscolo e 1 numero</li>
    </ul>
    <form name="email" class="hidden">
        @csrf
        <p>
            <label>Email attuale: <input type="text" name="old_email" value= @if (isset($user)) {{ $user->email }} @endif></label>
        </p>
        <p>
            <label>Inserisci la nuova email: <input type="text" name="new_email"></label>
        </p>
        <p>
            <label>&nbsp;<input type="submit" value="Cambia Email"></label>
            <!-- <input name="_token" type="hidden" value=<?php echo csrf_token()?> >    già presente con @csrf  -->
        </p>
    </form>
    <form name="password" class="hidden">
        @csrf
        <p>
            <label>Inserisci la vecchia password: <input type="password" name="old_password"></label>
        </p>
        <p>
            <label>Inserisci la nuova password: <input type="password" name="new_password"></label>
        </p>
        <p>
            <label>&nbsp;<input type='submit' value='Cambia Password'></label>
            <!-- <input name="_token" type="hidden" value=<?php echo csrf_token()?> >    già presente con @csrf  -->
        </p>
    </form>
    <button>Torna indietro</button>
</div>
@endsection