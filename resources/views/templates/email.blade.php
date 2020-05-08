<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('email.subject', 'Notification ' . $shopName)</title>
</head>
<body>
    @yield('email.content')
</body>
</html>
