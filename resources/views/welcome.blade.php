@extends('layouts.app')
@section('title_page', 'Página inicial')

@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

        {{-- @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Página inicial</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Cadastrar-se</a>
                    @endif
                @endauth
            </div>
        @endif  --}}

        <div class="container">
            <h2 class='text-center text-success'>Mantenha vigilância constante em seus sites com a <span class="{{config('app.bold')}}">Intercorp web</span></h2>

            <div class="row mt-5">
                <div class="col-lg-4 col-sm-12">
                    <i class="{{config('app.material')}} md-100 d-flex justify-content-center my-3 text-info">person_pin</i>
                    <h5 class='text-center font-weight-bold text-secondary'>1º Passo - Efetue seu login ou cadastre-se</h5> 
                </div>
                <div class="col-lg-4 col-sm-12">
                    <i class="{{config('app.material')}} md-100 d-flex justify-content-center my-3 text-info">http</i>
                    <h5 class='text-center font-weight-bold text-secondary'>2º Passo - Cadastre os  sites que deseja monitorar</h5>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <i class="{{config('app.material')}} md-100 d-flex justify-content-center my-3 text-info">trending_up</i>
                    <h5 class='text-center font-weight-bold text-secondary'>3º Passo - Acompanhe a cada minuto o monitoramento dos seus sites</h5>                    
                </div>
            </div>
        </div>
@endsection