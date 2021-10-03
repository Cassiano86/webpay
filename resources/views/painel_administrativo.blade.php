@extends('layouts.app')
@section('title_page', 'Painel administrativo')

@section('content')
    <div class="container">
        <div class="row table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">URL</th>
                        <th scope="col">Status</th>
                        <th scope="col">Quantidade de acessos</th>
                        <th scope="col" colspan='3'>Ações</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
