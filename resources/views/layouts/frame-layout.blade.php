<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/actions.js') }}" defer></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

   
        <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
        
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    </head>
    <body class="font-sans antialiased">

        <section id = 'mainPage-Container' class = 'flex-row space-between'>        

        <aside class = 'side-menuBar flex-column align-center'>
            <!-- @include('components.header') -->
        </aside>

        <main id = 'mainContent-Wrapper' class =  'flex-column'>
            {{ $slot }}
        </main>

          
    </body>
</html>

<style>
    .max_width_large {
        max-width: 1400px;
    }
    main {

        min-height: 120vh;
    }
</style>