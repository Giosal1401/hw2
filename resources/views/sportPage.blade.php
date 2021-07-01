@extends('principale')

@section('title','Sport')

@push('styles')
<link rel="stylesheet" href="{{ url('styles/sport.css') }}">
@endpush

@push('scripts')
<script src="{{ url('scripts/sport.js') }}" defer="true"></script>
@endpush

@section('link')
<a href="{{ route('home') }}">Home</a>
@parent
@endsection

@section('menu')
<a href="{{ route('music') }}">Music</a>
<div></div>
<a href="{{ route('home') }}">Home</a>
<div></div>
<a href="{{ route('account') }}">Account</a>
@endsection

@section('slogan')
<div class="slogan">
    <h1>Scopri la tua passione</h1>
    <p>Scopri lo sport più adatto a te e dai il via ai tuoi allenamenti</p>
</div>
@endsection

@section('content')
<div>
    <h1>Perché fare sport è importante?</h1>
    <p>L'attività fisica aiuta a controllare lo stress e conferisce uno stato di benessere generale, ed è inoltre fondamentale per poter 
    raggiungere e mantenere un peso corporeo sano e per ridurre il rischio di malattie croniche.</p>
</div>

<div>
    <h1>Non sai che sport fare?</h1>
    <h3>Scoprilo tra queste categorie:</h3>
    <section id="team" class="view"></section>
    <button id="reset" class="hidden">Torna indietro</button>
    <section id="resultTeam" class="view"></section>
</div>

<div>
    <h1>Non hai trovato nulla, fai una ricerca manuale!</h1>
    <article>
        <h3>Cerca lo sport ideale per te</h3>
        <form>
            <input type="text" id="nameSport">
            <input type="submit" value="cerca">
        </form>
    </article>
</div>

<section id="sport" class="view"></section>
</section>
@endsection