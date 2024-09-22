<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/js/app.js'])
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <form id="ai">
        <input name="prompt"></input>
        <button type="submit">Ask AI</button>
    </form>
    AI Ask : <span id="ai-ask"></span> <br>
    AI Reply :<p style="background: #ededed;" id="ai-reply"></p>

    <div id='error' style="color: red;"></div>
</body>

</html>