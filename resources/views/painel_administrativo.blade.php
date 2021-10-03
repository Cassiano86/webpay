@extends('layouts.app')
@section('title_page', 'Painel administrativo')

@section('content')
    <div class="container px-0">
        <div class="row my-3">
            <a href="{{route('url.create')}}" title="Adicionar uma nova url" class='btn btn-primary d-block ml-auto mr-4 p-2'>
                <i class="{{config('app.material')}}">add</i> Adicionar url
            </a>
        </div>
        <div class="row table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">URL</th>
                        <th scope="col">Status</th>
                        <th scope="col">Acessos</th>
                        <th scope="col" colspan='3'>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($urls as $url)
                        <tr id="linha_{{$url->id}}">
                            <td>
                                <small>{{$url->url}}</small>
                            </td>
                            <td id="url_{{$url->id}}">
                                @if($url->status == null)
                                    <span class="text-secondary {{config('app.bold')}}">
                                        <i class="{{config('app.material')}}">timer</i> Aguardando
                                    </span>
                                @elseif($url->status >= 200 &&  $url->status <= 226)
                                    <span class="text-success {{config('app.bold')}}">
                                        <i class="{{config('app.material')}}">check</i> {{$url->status}}
                                    </span>
                                @elseif($url->status >= 400 &&  $url->status <= 451)
                                    <span class="text-danger {{config('app.bold')}}">
                                        <i class="{{config('app.material')}}">warning</i> {{$url->status}}
                                    </span>
                                @elseif($url->status >= 500 &&  $url->status <= 511)
                                    <span class="text-warning {{config('app.bold')}}">
                                        <i class="{{config('app.material')}}">warning</i> {{$url->status}}
                                    </span>
                                @endif
                            </td>
                            <td>{{$url->quantidade_acesso}}</td>
                            <td>
                                <div class="row mx-auto">
                                    <div class="col-lg-4">
                                        <a href="{{ route('url.show', encrypt(auth()->user()->id)) }}" class="btn btn-success rounded-pill {{config('app.bold')}}" data-toggle="tooltip" data-placement="top" title="Visualizar relatório">
                                            <i class="{{config('app.material')}}">description</i>
                                        </a>
                                    </div>
                                    <div class="col-lg-4">
                                        <a href="{{route('url.edit', encrypt($url->id))}}" class="btn btn-info rounded-pill {{config('app.bold')}} text-white" data-toggle="tooltip" data-placement="top" title="Atualizar url">
                                            <i class="{{config('app.material')}}">autorenew</i>
                                        </a>
                                    </div>
                                    <div class="col-lg-4">
                                        <button class="btn btn-danger rounded-pill {{config('app.bold')}}" data-href="{{ route('url.destroy', encrypt($url->id)) }}" data-toggle="tooltip" data-placement="top" title="Deletar url">
                                            <i class="{{config('app.material')}}">delete_forever</i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan='6'>
                                <h4 class="text-center text-info font-weight-bold">
                                    <i class="{{config('app.material')}}">language</i> Nenhuma url cadastrada até o momento
                                </h4>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{$urls->onEachSide(5)->links()}}
        </div>
    </div>

    @include('url.modals.modal_deletar_url')
    @push('js')
        <script src="{{asset('js/painel_administrativo.js')}}"></script>
    @endpush
@endsection
