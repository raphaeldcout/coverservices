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
                                    @if($editarChamado != null)
                                    @foreach($editarChamado as $editarChamados)
                                    <input type="hidden" id="idChamado" name="idChamado" value="{{ $editarChamados['idChamado'] }}">
                                    @endforeach
                                    @endif
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Título Chamado</label>
                                                @if($editarChamado == null)
                                                <input type="text" id="titulo" name="titulo" class="form-control" required>
                                                @else
                                                @foreach($editarChamado as $editarChamados)
                                                <input id="titulo" name="titulo" rows="5" style="color: black; border-color: transparent" value="{{ $editarChamados['titulo'] }}" class="form-control" readonly>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Descreva o problema detalhadamente</label>
                                                @if($editarChamado == null)
                                                <textarea id="descricao" rows="5" name="descricao" class="form-control" required></textarea>
                                                @else
                                                @foreach($editarChamado as $editarChamados)
                                                <textarea id="descricao" name="descricao" rows="5" class="form-control" readonly>{{ $editarChamados['descricao'] }}</textarea>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Categoria do Chamado</label>
                                                @if($editarChamado == null)
                                                <select id="categoria" name="categoria" class="custom-select" required>
                                                    <option value="-1">-- Selecione --</option>
                                                    @foreach($categorias as $categoria)
                                                    <option value="{{ $categoria['id'] }}">{{ $categoria['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                @else
                                                @foreach($editarChamado as $editarChamados)
                                                <input id="categoria" name="categoria" rows="5" style="color: black; border-color: transparent" value="{{ $editarChamados['categoriaNome'] }}" class="form-control" readonly>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Tipo de problema</label>
                                                @if($editarChamado == null)
                                                <select id="problema" name="problema" class="custom-select" required>
                                                    <option value="-1">-- Selecione --</option>
                                                </select>
                                                @else
                                                @foreach($editarChamado as $editarChamados)
                                                <input id="problema" name="problema" rows="5" style="color: black; border-color: transparent" value="{{ $editarChamados['problemaNome'] }}" class="form-control" readonly>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Setor</label>
                                                @if($editarChamado == null)
                                                <select id="setor" name="setor" class="custom-select" required>
                                                    <option value="-1">-- Selecione --</option>
                                                    @foreach($setores as $setor)
                                                    <option value="{{ $setor['id'] }}">{{ $setor['name'] }}</option>
                                                    @endforeach
                                                </select>
                                                @else
                                                @foreach($editarChamado as $editarChamados)
                                                <input id="setor" name="setor" rows="5" style="color: black; border-color: transparent" value="{{ $editarChamados['setorNome'] }}" class="form-control" readonly>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if($editarChamado != null)
                                        @if(Auth::user()->hierarquia == 2 || Auth::user()->hierarquia == 3)
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Atribuir Status</label>
                                                            @foreach($editarChamado as $editarChamados)
                                                                <input type="hidden" id="statusController" name="statusController" value="{{ $editarChamados['status'] }}">
                                                                <select id="status" name="status" class="custom-select">
                                                                    <option value="Aberto" selected>Aberto</option>
                                                                    <option value="Pendente" selected>Pendente</option>
                                                                    <option value="Encerrado" selected>Encerrado</option>
                                                                </select>
                                                            @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Atribuir Chamado</label>
                                                        <select id="atendente" name="atendente" class="custom-select" required>
                                                            <option value="-1">-- Selecione --</option>
                                                            @foreach($atendentes as $atendente)
                                                                @if($alterar['codigo_atendente'] == $atendente['id'])
                                                                    <option value="{{ $atendente['id'] }}" selected>{{ ucwords($atendente['name']) }}</option>
                                                                @else
                                                                    <option value="{{ $atendente['id'] }}">{{ ucwords($atendente['name']) }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Prévia da ação</label>
                                                        <input id="tituloAcao" rows="5" name="tituloAcao" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label class="bmd-label-floating">Ação</label>
                                                        <textarea id="descricaoAcao" rows="5" name="descricaoAcao" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            @else
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label class="bmd-label-floating">Status do Chamado</label>
                                                                @foreach($editarChamado as $editarChamados)
                                                                    @if($editarChamados['status'] !== 'Aberto')
                                                                        <input type="hidden" id="statusController" name="statusController" value="{{ $editarChamados['status'] }}">
                                                                        <select id="status" name="status" class="custom-select">
                                                                            <option value="Pendente" selected>Pendente</option>
                                                                            <option value="Encerrado" selected>Encerrado</option>
                                                                        </select>
                                                                    @endif    
                                                                @endforeach                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif
                                    @endif
                                    
                                    @if($editarChamado == null)
                                        <button type="submit" class="btn btn-info pull-right">Cadastrar chamado</button>
                                    @else
                                        @if(Auth::user()->hierarquia == 2 || Auth::user()->hierarquia == 3)
                                            <div class="row" style="margin-top: 50px">
                                                <div class="col-md-9">
                                                    <div>
                                                        <input type="file" id="anexo" name="anexo">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-info pull-right">Atualizar Chamado</button>
                                        @endif
                                    @endif
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->hierarquia == 2 || Auth::user()->hierarquia == 3)
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 mt-4">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">Historico de Ações</h4>
                                    </div>
                                    <div class="card-body">                                    
                                        @if($acoes != null)
                                            @foreach($acoes as $acao)
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label class="bmd-label-floating">Prévia da ação</label>
                                                            <input id="tituloAcao_{{ $acao['id'] }}" name="tituloAcao_{{ $acao['id'] }}" value="{{ $acao['titulo'] }}" readonly rows="5" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <label class="bmd-label-floating">Ação</label>
                                                            <textarea id="descricaoAcao_{{ $acao['id'] }}" name="descricaoAcao_{{ $acao['id'] }}" readonly rows="5" class="form-control">{{ $acao['descricao'] }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection