<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="{{ asset('build/assets/images/logo.svg') }}" rel="shortcut icon">
    <link href="" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Possibly the best pump booking system in Australia. Built by Screwloose IT exclusively for Rowland Contractors.">
    <meta name="keywords" content="">
    <meta name="author" content="Screwloose IT">
    

    @yield('head')

    <!-- BEGIN: CSS Assets-->
    @vite('resources/css/app.css')
    <!-- END: CSS Assets-->
    @livewireStyles
</head>
<!-- END: Head -->

@yield('body')
@livewireScripts
</html>
