<!-- resources/views/components/layouts/public.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NMIS Establishment Compliance Lookup</title>

    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gray-50 text-gray-900 min-h-screen font-sans">
    {{ $slot }}

    @livewireScripts
</body>

</html>