@extends('layouts.app')
@section('title_page', 'Adicionar url')
@push('css')
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container col-8 mx-auto">
        <div class="row my-3">
            <a href="{{route('home')}}" title="Adicionar uma nova url" class='btn btn-success d-block ml-auto mr-3 p-2'>
                <i class="{{config('app.material')}}">arrow_back</i> Visualizar url
            </a>
        </div>      
    </div>

    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
@endsection