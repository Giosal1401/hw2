<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fitness Lifestyle - Login</title>
        <link rel="icon" type="image/png" href=" {{ url('images/icon.png')}}">
        <link rel="stylesheet" href="styles/login.css" />
        <script src="scripts/script_menu.js" defer="true"></script>
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
                        <a href="home.php">Home</a>
                        <a href="account.php">Account</a>
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
                        <a href="home.php">Home</a>
                        <div></div>
                        <a href="account.php">Account</a>
                    </div>
                </div>
            </nav>
        </header>

        <section>
            <h1>Accedi al tuo account</h1>

            <?php
            if (isset($errore)) {
                echo "<p class='errore'>" . $errore . "</p>";
            }
            ?>

            <main>
                <form name="autenticazione" method="post">
                    <p>
                        <label>Inserisci Email/Nome utente <input type="text" name="username"></label>
                    </p>
                    <p>
                        <label>Inserisci Password <input type="password" name="password"></label>
                    </p>
                    <p>
                        <label>&nbsp;<input type="submit" value="Accedi"></label>
                        <input type="hidden" name="_token" value=<?php  csrf_token(); ?>>
                    </p> 
                </form>
            </main>

            <div>
                <h3>Non sei iscritto?</h3>
                <a href="registrazione.php">Clicca qui</a>
            </div>
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