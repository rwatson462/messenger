<html lang="en">
    <head>
        <title>Messenger :: Conversations</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
    </head>
    <body>
        <nav>
            @auth
                <p>
                    <a href="{{ route('logout') }}">Logout</a>
                    {{ auth()->user()->name }}
                </p>
            @endauth
        </nav>
        <h1>Messenger</h1>
        {{ $slot }}
    </body>
</html>
