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
                                                        <input type="hidden" id="titulo" name="titulo" value="{{ $editarChamados['titulo'] }}">
                                                        <input id="titulo" rows="5" style="color: black; border-color: transparent" name="titulo" value="{{ $editarChamados['titulo'] }}" class="form-control" required>
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
                                                            <input type="hidden" id="descricao" name="descricao" value="{{ $editarChamados['descricao'] }}">
                                                            <input id="descricao" style="color: black; border-color: transparent" rows="5" name="descricao" value="{{ $editarChamados['descricao'] }}" class="form-control" required>
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
                                                            <input type="hidden" id="categoria" name="categoria" value="{{ $editarChamados['codigo_categoria'] }}_{{ $editarChamados['categoriaNome'] }}">
                                                            <input readonly style="color: black; border-color: transparent" value="{{ $editarChamados['categoriaNome'] }}">
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
                                                            <input type="hidden" id="problema" name="problema" value="{{ $editarChamados['codigo_problema'] }}_{{ $editarChamados['problemaNome'] }}">
                                                            <input readonly style="color: black;border-color: transparent" value="{{ $editarChamados['problemaNome'] }}">
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
                                                            <input type="hidden" id="setor" name="setor" value="{{ $editarChamados['codigo_setor'] }}_{{ $editarChamados['setorNome'] }}">
                                                            <input readonly style="color: black; border-color: transparent" value="{{ $editarChamados['setorNome'] }}">
                                                        @endforeach
                                                    @endif
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
                                    @if($editarChamado == null)
                                        <button type="submit" class="btn btn-info pull-right">Cadastrar chamado</button>
                                    @else
                                        <button type="submit" class="btn btn-info pull-right">Editar chamado</button>
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
</div>
@endsection