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
                        <th id="dataChamado" style="text-align: center;">
                          Data Abertura
                        </th>
                        <!-- <th style="text-align: center;">
                          Editar -->
                        <!-- </th> -->
                      </thead>
                      <tbody>
                        @foreach($chamados as $chamado)
                        <tr>
                          <td style="text-align: center;">
                            <label id='idChamado'   style="color: black; text-align: center;border-color: transparent">{{ $chamado['idChamado'] }}</label>
                          </td>
                          <td style="text-align: center;">
                            <label id='tituloChamado'style="color: black; text-align: center;border-color: transparent">{{ $chamado['titulo'] }}</label>
                          </td>
                          <td style="text-align: center;">
                            <label id='tituloChamado'style="color: black; text-align: center; border-color: transparent">
                              {{ \Illuminate\Support\Str::limit($chamado['descricao'], 100, $end='...') }}
                            </label>
                          </td>
                          <td style="text-align: center;">
                            <input value="{{ $chamado['created_at'] }}" style="text-align: center;border-color: transparent">
                          </td>
                          <!-- <td>
                            <button type="button" rel="tooltip" title="" class="btn btn-warning btn-link btn-sm">
                              <a href="{{ route('chamados', ['chamadoid' => $chamado['idChamado'] ]) }}"><i class="material-icons">edit</i></a>
                            </button>
                          </td> -->
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