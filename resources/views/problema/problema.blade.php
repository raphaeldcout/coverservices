@extends('layouts.master')
@section('conteudo')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="card">
                            <div class="card-header card-header-info">
                                <h4 class="card-title">Cadastro de Problemas</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('cadastrar_problema')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Nome do Problema</label>
                                                <input type="text" id="nome" name="nome" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Categoria do Problema</label>                                                                                                 
                                                        <select id="categoria" name="categoria" class="custom-select" required>   
                                                        <option value="-1">-- Selecione --</option>
                                                            @foreach($categorias as $categoria)
                                                                <option value="{{ $categoria['id'] }}">{{ $categoria['name'] }}</option>
                                                            @endforeach                                                            
                                                        </select>
                                            </div>
                                        </div>
                                    </div>                          
                                    <button type="submit" class="btn btn-info pull-right">Cadastrar Categoria</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
{{--<script src="/js/core/jquery.min.js"></script>--}}
@endsection