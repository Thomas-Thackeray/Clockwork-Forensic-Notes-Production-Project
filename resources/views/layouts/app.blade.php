<!-- Created By Thomas Thackeray C3554686 -->
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
        <link rel="stylesheet" href="{{ asset('css/css.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/script.js') }}" defer></script>
        
        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    </head>
    <body id="body-padding" class="font-sans antialiased " :case_name="$case_name">


        @include('back-view-structure.header')
        @include('back-view-structure.nav_sidebar')    

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
