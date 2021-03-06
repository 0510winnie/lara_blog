<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- CSRF token 為了前端js獲取csrf令牌-->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'LaraBlog') - 部落格</title>

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Gaegu" rel="stylesheet">

  <!-- Text Editor -->
    @include('common._editor_style')

</head>
<body>
  <div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')

    <div class="container app_container">
      @include('common.message')
      @yield('content')
    </div>

    @include('layouts._footer')
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>
   @include('common._editor_scripts')
  
</body>
</html>