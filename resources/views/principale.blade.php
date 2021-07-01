<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fitness Lifetyle - @yield('title')</title>
        <link rel="icon" type="image/png" href=" {{ url('images/icon.png')}}">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Oswald:wght@300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        @stack('styles')
        @stack('scripts')
    </head>

    <body>
        <header>
            <nav>
                <div class="bar">
                    <div class="logo">
                        Fitness Lifestyle
                        <img src="{{ url('images/logo.png') }}" />
                    </div>

                    <div class="link">
                        @section('link')
                        <a href="{{ route('account') }}">Account</a>
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
                    <div>
                        <div id="menu">
                            <a>Menu</a>
                        </div>

                        <div id="menuAperto" class="hidden">
                            @yield('menu')
                        </div>
                    </div>
                    
                    @yield('user_details')
                </div>
            </nav>

            @yield('slogan')
        </header>

        <section>
        @yield('content')
        </section>

        <section id="modal-view" class="hidden">
        @yield('modal_content')
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
    </body>
</html>