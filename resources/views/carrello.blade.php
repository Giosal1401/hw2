@extends('secondario')

@section('title','Carrello')

@push('styles')
<link rel="stylesheet" href="{{ url('styles/carrello.css') }}" />
@endpush

@push('scripts')
<script src="{{ url('scripts/carrello.js') }}" defer="true"></script>
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
<div>
    <div @if (!isset($user)) class="hidden" @elseif ($user->nprodotticarrello == 0 && $user->nprodottipreferiti == 0) class ="upper_view" @endif>
        <h1>I tuoi prodotti aggiunti al carrello</h1>
        <div class="grid" id="carrello"></div>
    </div>

    <div @if (!isset($user) ||  ($user->nprodottipreferiti == 0) ) class="hidden" @endif>
        <h2>Non dimenticare di acquistare i tuoi prodotti preferiti</h2>
        <div class="grid" id="preferiti"></div>
    </div>
</div>
            
<div @if (isset($user)) class="hidden" @endif>
    <h1>Devi prima accedere al tuo account</h1>
    <p>Non sei iscritto?<a href="{{ route('register') }}">Registrati qui</a></p>
    <p>Sei già iscritto?<a href="{{ route('login') }}">Accedi</a></p>
</div>

<section id="modal-view" class="hidden">
    <div>
        <form>
            <!-- @csrf -->
            <p>
                <input name="id_prodotto" type="hidden">
                <input name="_token" type="hidden" value=<?php  echo csrf_token(); ?>>
                <input name="operazione" type="hidden" value="add">
            </p>
            <p>
                <label>Quantità: <input type="text" name="quantità" value="1"></label>
            </p>
            <p>
                <label>&nbsp;<input type='submit' value='Acquista'></label>
            </p>
        </form>
        <button>Torna indietro</button>
    </div>
</section>

<section id="checkout-modal" class="hidden">
    <div>
        <p>Sei sicuro di procedere con l'acquisto?</p>
        <span>
            <button class="white_button">Torna indietro</button>
            <button class="lightblue_button">Procedi</button>
        </span>
    </div>
</section>
@endsection