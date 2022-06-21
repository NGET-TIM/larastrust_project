<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel 8 - VueJS 3</title>
        <link rel="shortcut icon" href="{{ asset('assets/images/new.png') }}">
        
        <link rel="stylesheet" href="<?= asset('assets/dist/css/adminlte.css')?>">
        <link rel="stylesheet" href="<?= asset('assets/css/frontEnd/frontEnd.css')?>">
        <!-- PWA  -->
        <meta name="theme-color" content="#6777ef"/>
        <link rel="apple-touch-icon" href="{{ asset('Nget_Tim.jpg') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">

    </head>
    <body class="antialiased">
        <a tabindex="0" class="btn btn-lg btn-danger " id="myTooltip" role="button" data-placement="bottom" data-toggle="popover" data-trigger="focus" title="Dismissible popover" data-content="<b>And</b> here's some amazing content. It's very engaging. Right?">Dismissible popover</a>
        <button type="button" class="btn btn-lg btn-danger " data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>
        <?= NT::payment_status("pending"); ?>
        <?= $status ?>
        <div id="app"></div>

        

        <script src="<?= asset('assets/plugins/jquery/jquery.min.js')?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
        <script src="<?php echo asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="<?php echo asset('assets/js/frontEnd.js') ?>"></script>
        <script src="{{ asset('/sw.js') }}"></script>
        <script>
            if (!navigator.serviceWorker.controller) {
                navigator.serviceWorker.register("/sw.js").then(function (reg) {
                    console.log("Service worker has been registered for scope: " + reg.scope);
                });
            }
        </script>
    </body>
</html>
