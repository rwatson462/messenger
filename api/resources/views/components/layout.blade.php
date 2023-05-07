<html lang="en">
    <head>
        <title>Messenger :: Conversations</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
    </head>
    <body>
        <nav>
            <p><a href="{{ route('logout') }}">Logout</a></p>
        </nav>
        <h1>Messenger</h1>
        <section>
            {{ $slot }}
        </section>
    </body>
</html>
