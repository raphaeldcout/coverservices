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
                                <h4 class="card-title">Abertura de Chamados</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route('cadastrar_chamado')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_tokenvalue" value="{{ csrf_token() }}">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Título Chamado</label>
                                                <input type="text" id="titulo" name="titulo" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Descreva o problema detalhadamente</label>
                                                <textarea id="descricao" rows="5" name="descricao" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Categoria do Chamado</label>
                                                <select id="categoria" name="categoria" class="custom-select" required>
                                                    <option value="-1">-- Selecione --</option>
                                                    
                                                    @foreach($categorias as $categoria)
                                                        <option value="{{ $categoria['id'] }}">{{ $categoria['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Tipo de problema</label>
                                                <select id="problema" name="problema" class="custom-select" required>
                                                    <option value="-1">-- Selecione --</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Setor</label>
                                                <select id="setor" name="setor" class="custom-select" required>
                                                    <option value="-1">-- Selecione --</option>
                                                    @foreach($setores as $setor)
                                                        <option value="{{ $setor['id'] }}">{{ $setor['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 50px">
                                        <div class="col-md-9">
                                            <div>
                                                <input type="file" id="anexo" name="anexo">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info pull-right">Cadastrar chamado</button>
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