@extends('layouts.master')
@section('conteudo')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
        <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">Acompanhar Chamados</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-info">
                        <th style="text-align: center;">
                          Código Chamado
                        </th>
                        <th style="text-align: center;">
                          Titulo Chamado
                        </th>
                        <th style="text-align: center;">
                          Descrição Chamado
                        </th>
                        <th style="text-align: center;">
                          Data Abertura
                        </th>
                        <th style="text-align: center;">
                          Editar
                        </th>
                      </thead>
                      <tbody>
                        @foreach($chamados as $chamado)
                        <tr>
                          <td style="text-align: center;">
                            <label id='idChamado'>{{ $chamado['id'] }}</label>
                          </td>
                          <td style="text-align: center;">
                            <label id='tituloChamado'>{{ $chamado['titulo'] }}</label>
                          </td>
                          <td style="text-align: center;">
                            <label id='tituloChamado'>{{ $chamado['descricao'] }}</label>
                          </td>
                          <td style="text-align: center;">
                            <label id='dataChamado'>{{ $chamado['created_at'] }}<label>
                          </td>
                          <td>
                            <a href="{{ route('chamados', ['chamadoid' => $chamado['id'] ]) }}">
                              <input id="editarChamado" type="button" class="btn btn-warning btn-link btn-sm">
                            </a>
                          </td>
                        </tr>
                        @endforeach                       
                      </tbody>
                    </table>
                  </div>
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