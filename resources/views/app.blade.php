<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @vite('resources/js/app.js')
    <script src="{{ asset('applause-button.js') }}"></script>
    <script>
        if (
            localStorage.theme === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        )
            document.documentElement.classList.add('dark-theme');
        else document.documentElement.classList.remove('dark-theme');
    </script>
    @inertiaHead
</head>
<body>
@inertia
</body>
</html>
