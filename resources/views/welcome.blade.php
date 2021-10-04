@extends('layouts.app')
@section('title_page', 'Painel administrativo')

@section('content')
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0"><!-- 
        @if (Route::has('login'))
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
        @endif -->

        <div class="container">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <h2 class='text-center'>Links disponíveis</h2>
                <div class="table-responsive mt-3">
                    <table class="table table-hover table-bordered text-center">
                        <thead class='thead-dark'>
                            <th scope='col'>Links disponíveis</th>
                            <th scope='col'>Responsável</th>
                            <th scope='col'>Visitar</th>
                        </thead>
                        <tbody>
                            @foreach($urls as $url)
                                <tr>
                                    <td>
                                        {{$url->url}}
                                    </td>
                                    <td>{{$url->User->name}}</td>
                                    <td>
                                        <a id="{{encrypt($url->id)}}" class="{{config('app.bold')}}" href="{{$url->url}}" target="_blank" title='Acessar url'>
                                            <i class="{{config('app.material')}}">language</i> Clique aqui
                                        </a>
                                    </td>
                                </tr>  
                            @endforeach                            
                        </tbody>
                    </table>
                    {{$urls->onEachSide(5)->links()}}
                </div>
            </div>
        </div>

    @push('js')
        <script src="{{asset('js/index.js')}}"></script>
    @endpush
@endsection