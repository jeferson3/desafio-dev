<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body class="antialiased">
        @if(session('message'))
            <div class="alert alert-message">
                <span>{{ session('message') }}</span>
            </div>
        @endif
        <div class="container">
            <h1>Formulário Upload</h1>
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="file" name="file" class="upload" accept=".txt">
                </div>
                <button type="submit" class="btn font-semibold">Enviar</button>
            </form>
            <div class="errors">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="color: red">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
