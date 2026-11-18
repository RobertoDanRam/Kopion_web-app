<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kopion & La Capital del Café - Order Tracking</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="background-color: #f4f1ea; margin: 0; padding: 20px;">
        <div id="app">
            <order-tracking></order-tracking>
        </div>
    </body>
</html>