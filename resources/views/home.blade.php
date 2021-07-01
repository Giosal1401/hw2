@extends('principale')

@section('title','Home')

@push('styles')
<link rel="stylesheet" href="{{ url('styles/home.css')}}" />
@endpush

@push('scripts')
<script src="{{ url('scripts/home.js') }}" defer="true"></script>
@endpush

@section('link')
@parent
<a href="{{ route('carrello') }}">Carrello</a>
@endsection

@section('menu')
<a href="{{ route('music') }}">Music</a>
<div></div>
<a href="{{ route('sport') }}">Sport</a>
<div></div>
<a href="{{ route('account') }}">Account</a>
<div></div>
<a href="{{ route('carrello') }}">Carrello</a>
@endsection

@section('user_details')
<div id="userDetails">
    <div class="showDetails hidden" id="accountDetails">
        <div @if(!isset($user)) class="hidden" @endif>
            <p>Bentornato @if(isset($user)) {{ $user }}! @else null @endif</p>
        </div>
        <div @if(isset($user)) class="hidden" @endif>
            <p>Benvenuto!</p>
        </div>
    </div>

    <div class="showDetails hidden" id="cartDetails">
        <div @if(!isset($user)) class="hidden" @endif>
            <p>Totale prodotti: @if(isset($user)) {{ $prodotti_carrello}} @else null @endif</p>
        </div>
        <div @if(isset($user)) class="hidden" @endif>
            <p>Prima devi registrarti!</p>
        </div>
    </div>
</div>
@endsection

@section('slogan')
<h1>
    <strong>Fuel Your Ambition</strong>
    <a href="{{ route('novita') }}">Scopri le novità</a>
</h1>
@endsection

@section('content')
<h1>i nostri prodotti</h1>

<div class="details">
    <div>
        <h1>
            nutrizione
        </h1>
        <img src="{{ url('images/nutrizione.jpg') }}" />
        <p>
            Scopri gli elementi adatti alle tue esigenze.
        </p>
    </div>

    <div>
        <h1>
            abbigliamento
        </h1>
        <img src="{{ url('images/abbigliamento.jpg') }}" />
        <p>
            Qualunque sia il tuo stile di allenamento, abbiamo quello di cui hai bisogno.
        </p>
    </div>

    <div>
        <h1>
            attrezzatura
        </h1>
        <img src="{{ url('images/attrezzatura.jpg') }}" />
        <p>
            Scopri la nostra collezione di pesi, attrezzi e accessori per definire la tua muscolatura.
        </p>
    </div>
</div>

<section class="paragrafo">
    <div class="preferiti">
        <h1>I tuoi preferiti</h1>
    </div>
    <div class="grid" id="risultatiPreferiti"></div>
</section>

<section class="paragrafo">
    <div class="elementi">
        <h1>Tutti gli elementi</h1>
        <form>
            Cerca<input type="text">
        </form>
    </div>
    <div class="grid" id="grid_elements"></div>
</section>
@endsection

@section('modal_content')
<div>
    <form name="acquisto" class="hidden">
        <p>
            <input name="id_prodotto" type="hidden" />
            <input name="operazione" type="hidden" value="add" />
            <input name="_token" type="hidden" value=<?php  echo csrf_token(); ?>>
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
@endsection