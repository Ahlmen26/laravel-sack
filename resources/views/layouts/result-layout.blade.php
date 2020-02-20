<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>SACK 3.0</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="{{ asset('dashboard-assets/css/material-dashboard.css?v=2.1.1') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/material-kit.css?v=2.0.5') }}" rel="stylesheet" />

  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon_wtw.ico') }}" rel="stylesheet" />
</head>
<body>
    <div id="app" class="container">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
