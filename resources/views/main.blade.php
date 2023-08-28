<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>保育記事一覧</title>
    </head>
    <body>
        <h1>保育施設一覧</h1>
        <form action="/psots" method="POST">
            @csrf
            <a>test</a>
        </form>
    </body>