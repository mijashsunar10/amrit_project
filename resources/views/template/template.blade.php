<!DOCTYPE html>
<html lang="en">

<head>
	<title>BookSaw - Free Book Store HTML CSS Template</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="author" content="">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="{{asset('css/normalize.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('icomoon/icomoon.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/vendor.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('style.css')}}">

	  @vite(['resources/css/app.css', 'resources/js/app.js'])
      

</head>

<body>

<section id="header">
 @include('layouts.header')
</section>

  <section id="pagecontent" class="">
    @yield('pagecontent')
  </section>
  
  {{-- Add the panic button component --}}

  <section id="footer">
    
    @include('layouts.footer')
  </section>



</body>
</html>