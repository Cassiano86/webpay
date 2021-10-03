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
        
        <form action="{{route('url.update', encrypt($url->id))}}" method="POST" id="form_atualizar_url" class='p-2 border boder-secondary'>
            
            @csrf
            @method('PUT')

            <legend class="text-center text-muted">Atualizar url</legend>
            <div class="form-group">                
                <input type="url" name='url' id='url' class="form-control" value="{{old('url') ? old('url') : $url->url}}" required>
                <p class="text-danger font-weight-bold">{{$errors->has('url') ? $errors->first('url') : ''}}</p>
            </div>
            <div class="row">
                <button type='submit' class="btn btn-info rounded d-block ml-auto mr-3 text-white {{config('app.bold')}}">
                    <i class="{{config('app.material')}}">autorenew</i> Atualizar url
                </button>
            </div>
        </form>        
    </div>

    @push('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
@endsection