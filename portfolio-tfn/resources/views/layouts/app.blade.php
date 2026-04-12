<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  {{-- CSRF token untuk AJAX --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', $owner['name'] . ' — Portfolio')</title>

  {{-- CSS --}}
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"/>

  {{-- Google Fonts --}}
  <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet"/>

  {{-- Feather Icons --}}
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

  @stack('head')
</head>
<body>

{{-- Custom Cursor --}}
<div class="cursor" id="cursor"></div>
<div class="cursor-follower" id="cursorFollower"></div>

{{-- Navbar --}}
@include('partials.navbar')

{{-- Mobile Menu --}}
@include('partials.mobile-menu')

{{-- Konten halaman --}}
@yield('content')

{{-- Footer --}}
@include('partials.footer')

{{-- Project Modal --}}
@include('partials.modal')

{{-- Script utama --}}
<script src="{{ asset('assets/js/script.js') }}"></script>
<script>feather.replace();</script>

@stack('scripts')
</body>
</html>
