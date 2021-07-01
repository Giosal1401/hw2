@extends('secondario')

@section('title','Novità')

@push('styles')
<link rel="stylesheet" href="{{ url('styles/novita.css') }}" />
@endpush

@push('scripts')
<script src="{{ url('scripts/novita.js') }}" defer="true"></script>
@endpush

@section('link')
@parent
<a href="{{ route('account') }}">Account</a>
<a href="{{ route('carrello') }}">Carrello</a>
@endsection

@section('link_mobile')
@parent
<a href="{{ route('account') }}">Account</a>
<div></div>
<a href="{{ route('carrello') }}">Carrello</a>
@endsection

@section('content')
<div>
    <div> 
        <img src="images/banner-novita.jpg">
        <h1>Scopri i nostri prodotti più venduti</h1>
        <div class="grid" id="venduti"></div>
    </div>

    <div class="search">
        <h3>Cerca prodotto: </h3>
        <form class="search_form" name="search_products" method="get">
            @csrf
            <select name="prodotto">
                <option value="nutrizione">Nutrizione</option>
                <option value="attrezzatura">Attrezzatura</option>
                <option value="abbigliamento">Abbigliamento</option>
            </select>
            <select name="price">
                <option value="0-20">0-20 €</option>
                <option value="20-35">20-35€</option>
                <option value="35-60">35-60 €</option>
                <option value="60+">60+ €</option>
            </select>
            <input type="submit">
        </form>
    </div> 

    <div class="grid" id="risultati">
        <strong>Effettua una ricerca per trovare i prodotti adatti alle tue esigenze</strong>
    </div>
   
</div>
@endsection