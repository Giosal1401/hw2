@extends('principale')

@section('title','Music')

@push('styles')
<link rel="stylesheet" href="{{ url('styles/music.css') }}">
@endpush

@push('scripts')
<script src="{{ url('scripts/music.js') }}" defer="true"></script>
@endpush

@section('link')
<a href="{{ route('home') }}">Home</a>
@parent
@endsection

@section('menu')
<a href="{{ route('sport') }}">Sport</a>
<div></div>
<a href="{{ route('home') }}">Home</a>
<div></div>
<a href="{{ route('account') }}">Account</a>
@endsection

@section('slogan')
<div class="slogan">
    <h1>Allenati a ritmo di musica</h1>
    <p>La musica aiuta a rilassare i muscoli e allo stesso tempo a concentrarsi per dare il massimo durante i tuoi workout</p>
</div>
@endsection


@section('content')
<div>
    <h1>Perché dovresti ascoltare musica durante gli allenamenti?</h1>
    <p>Una giusta playlist in allenamento è capace di cancellare la stanchezza e motivarci.Ascoltare musica durante un allenamento lungo e intenso fa aumentare la motivazione, 
    il divertimento e le performance.</p>
</div>
<div>
    <h1>Quale musica ascoltare?</h1>
    <p>La musica da ascoltare dipende ovviamente anche dal tipo di sport che si pratica.
    Per le discipline che necessitano concentrazione e un’atmosfera rilassata (yoga, pilates) è bene scegliere brani soft, mentre per avere 
    ritmo e migliorare le prestazioni sono meglio i brani con ritmi serrati, tenendo conto che spesso anche i testi possono avere un effetto motivazionale.
    Per gli sport aerobici, per il bodybuilding, il fitness e l’aerobica è ideale la musica ritmata come il rock, la musica dance e anche alcuni brani pop.</p>
</div>
<div>
    <h1>La nostra playlist</h1>
    <p>La playlist Spotify della community di Fitness Lifestyle è composta da diverse categorie e ogni categoria è rappresentata da uno sport.
    Ogni nostro utente, accedendo al proprio account, può inserire le proprie canzoni preferite o quelle che ritiene più adeguate per praticare uno specifico sport.
    Aiutaci anche tu ad ampliare la nostra playlist; registrati al nostro sito,trova le tue canzoni preferite e aggiungile alla playlist.</p>
</div>
<article>
    <h1>Cerca il tuo brano preferito</h1>
    <form>
        <input type="text" id="music">
        <input type="submit" value="cerca">
    </form>
</article>
<section id="view">

</section>
@endsection

@section('modal_content')
<div>
    <p>Al momento questo servizio non è disponibile.
        <br></br>
        Ci scusiamo per il disagio
    </p>
    <button>Torna indietro</button>
</div>
@endsection