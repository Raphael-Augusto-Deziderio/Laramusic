@extends('site.template')
        @section('content')

   <title>{{$titulo or 'Erro - LaraMusc'}} </title>



<!--  img src="{{url('/assets/images/ImagensDashboard/404-laramusic.png')}}" alt="404"> -->
   <img src="{{url('/assets/Images/erro404.jpg')}}" alt="404">


@endsection