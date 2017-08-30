<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="{$templateWebPath}css/main.css" rel="stylesheet">
    <title>{$pageTitle}</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Главная</a>
            </li>
        </ul>
        <div style="padding-right: 10px;">
            <a href="/cart/" class="btn btn-outline-info">Корзина <span class="badge badge-info">
                    {if $cartCounts > 0} {$cartCounts} {else} 0 {/if}
                    </span>
            </a>
        </div>
        <div class="dropdown show">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {if isset($arrayUser)}
                    {$arrayUser['name']}
                {else}
                    Клиетам
                {/if}
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                {if isset($arrayUser)}
                    <a class="dropdown-item" href="/user/">Главная</a>
                    <a class="dropdown-item" href="/user/logout/">Выход</a>
                {else}
                    <a class="dropdown-item" href="/user/login/">Вход</a>
                    <a class="dropdown-item" href="/user/register/">Регистрация</a>
                {/if}
            </div>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
       {include file="leftcolomn.tpl"}
