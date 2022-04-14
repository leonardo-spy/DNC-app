@extends('layouts.master')

@section('header')
<style type="text/css">
   button.close {
    -webkit-appearance: none;
    padding: 0;
    cursor: pointer;
    background: 0 0;
    border: 0;
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: .2;
}
.btn-success {
    color: #3a3b45;
}
  </style>

@stop

<?php $page_name = "Cadastrar novo funcionário" ?>
@section('content')

<div class="container-fluid">
    
    <div class="card shadow">                    
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Cadastrar novo Funcionário</p>
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-bs-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-bs-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
            @if (count($errors) > 0)
            <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            </div>
            @endif
            <form method="post" class="user" action="{{ url('/manage/cadastrarfuncionario') }}">
            {{ csrf_field() }}
                <div class="row">
                    <div class="col">
                        <div class="mb-3"><label class="form-label" for="cpf"><strong>CPF</strong></label><input class="form-control" type="text" id="cpf" placeholder="CPF" name="cpf" onkeypress="$(this).mask('000.000.000-00');"></div>                        
                    </div>
                    <div class="col">
                    <div class="mb-3"><label class="form-label" for="nome"><strong>Nome</strong></label><input class="form-control" type="text" id="nome" placeholder="Nome" name="nome"></div>                    
                    </div>
                </div>                              
                <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Inserir</button></div>
            </form>
        </div>
    </div>
</div>
@stop

@section('scriptlogged')
{!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js') !!}
@endsection