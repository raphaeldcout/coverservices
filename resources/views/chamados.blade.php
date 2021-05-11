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
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Título Chamado</label>
                                                    <input type="text" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Status do Chamado</label>
                                                    <select class="custom-select">
                                                        <option value="1">Ativo</option>
                                                        <option value="2">Pendente</option>
                                                        <option value="3">Encerrado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Nível de urgência</label>
                                                    <select class="custom-select">
                                                        <option value="1">Baixo</option>
                                                        <option value="2">Médio</option>
                                                        <option value="3">Alto</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Nível de prioridade</label>
                                                    <select class="custom-select">
                                                        <option value="1">Baixo</option>
                                                        <option value="2">Médio</option>
                                                        <option value="3">Alto</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-9 ">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Resumo do problema</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Descreva o problema detalhadamente</label>
                                                    <input type="text" class="form-control">
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
