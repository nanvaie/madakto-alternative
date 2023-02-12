<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Madakto Alternative</title>
    <script data-id="sap-ui-config" type="application/json"> { "calendarType": "Persian" } </script>
    @vite('resources/scss/app.scss')
</head>

<body>
<div id="app"></div>

@vite('resources/js/app.js')
</body>

</html>
