<!DOCTYPE HTML>
<html lang="ja">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
  </title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        @yield('content')
    </body>
<html>