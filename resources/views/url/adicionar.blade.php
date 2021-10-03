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
        
        <form action="{{route('url.store')}}" method="POST" id="form_cadastrar_url" class='p-2 border boder-secondary'>
            @csrf
            <legend class="text-center text-muted">Cadastrar url</legend>
            <div class="form-group">                
                <input type="url" name='url' id='url' class="form-control" value="{{old('url')}}" required>
                <p class="text-danger font-weight-bold">{{$errors->has('url') ? $errors->first('url') : ''}}</p>
            </div>
            <div class="row">
                <button type='submit' class="btn btn-primary rounded d-block ml-auto mr-3">
                    <i class="{{config('app.material')}}">add</i> Nova url
                </button>
            </div>
        </form>        
    </div>

    @push('js')
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @endpush
@endsection