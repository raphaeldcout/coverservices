@extends('layouts.master')
@section('conteudo')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">Abertura de Chamados</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{route('cadastrar_chamado')}}" enctype="multipart/form-data">
                                        @csrf
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
                                                        <option value="1">Suporte Técnico</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Tipo de problema</label>
                                                    <select id="setor" name="setor" class="custom-select" required>
                                                        <option value="-1">-- Selecione --</option>
                                                        <option value="1">Manutenção de impressora</option>
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
                                                        <option value="1">Suporte Técnico de TI</option>
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
                                        <button type="submit" class="btn btn-primary pull-right">Cadastrar chamado</button>
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
</div>
@endsection
@section('scripts')
    {{--<script src="/js/core/jquery.min.js"></script>--}}
@endsection
