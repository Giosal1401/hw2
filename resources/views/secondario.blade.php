<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fitness Lifestyle - @yield('title')</title>
        <link rel="icon" type="image/png" href=" {{ url('images/icon.png')}}">
        @stack('styles')
        @stack('scripts')
        <script src="{{ url('scripts/script_menu.js') }}" defer="true"></script>
    </head>

    <body>
        <div id="container">
            <header>
                <nav>
                    <div class="bar">
                        <div class="logo">
                            Fitness Lifestyle
                            <img src="{{ url('images/logo.png') }}" />
                        </div>

                        <div class="link">
                            @section('link')
                            <a href="{{ route('home') }}">Home</a>
                            @show
                        </div>

                        <div class="menu_tendina">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                    <div class="impostazioni">
                        <div id="menuAperto" class="hidden">
                            @section('link_mobile')
                            <a href="{{ route('home') }}">Home</a>
                            <div></div>
                            @show
                        </div>
                    </div>
                </nav>
            </header>

            <section>
            @yield('content')
            </section>
            
            
            <footer>
                <div>
                    <img src=" {{ url('images/logo.png') }}" />
                    <h3>Fitness lifestyle</h3>
                </div>
                <p>
                    <strong>Giovanni Caschetto - Matricola O46002058</strong>
                    <em>email: giovannicasch@gmail.com</em>
                </p>
            </footer>
        </div>
    </body>
</html>