<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>Laravel</title>

            <!-- Styles -->
            <link type="text/css" rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div id="app">
            <main role="main">
                <section class="jumbotron text-center">
                    <div class="container">
                        <h1 class="jumbotron-heading">LaraVue Notes</h1>
                        <p class="lead text-muted">A basic <em>Note-Tacking</em> app based on Laravel &amp; Vue.</p>
                    </div>
                </section>

                <div class="bg-light">
                    <div class="container">
                        <notes-component></notes-component>
                    </div>
                </div>
            </main>

            <footer class="container">
                <div class="py-3 border-top border-primary">
                    <p class="text-center text-capitalize">Created by <a href="https://fullstack.mx">FullStack.MX</a> &copy; {{ date('Y') }}. Fork this project at <a href="https://github.com/FullStackMX/laravue-notes">GitHub/FullStackMX</a></p>
                </div>
            </footer>
        </div>

        <!-- Scripts -->
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
