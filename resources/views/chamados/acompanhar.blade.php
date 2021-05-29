@extends('layouts.master')
@section('conteudo')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-12 mt-4">
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
                        <th class="text-center">
                          Código
                        </th>
                        <th class="text-center">
                          Titulo
                        </th>
                        <th class="text-center">
                          Descrição
                        </th>
                        <th class="text-center">
                          Técnico
                        </th>
                        <th class="text-center">
                          Status
                        </th>
                        <th id="dataChamado" class="text-center">
                          Data Abertura
                        </th>
                        @if(Auth::user()->hierarquia == 2 || Auth::user()->hierarquia == 3)
                        <th class="text-center">
                          Ações
                        </th>
                        @else
                        <th class="text-center">
                          Visualizar
                        </th>
                        @endif
                      </thead>
                      <tbody>
                        @foreach($chamados as $chamado)
                        <tr>
                          <td class="text-center">
                            <label id='idChamado' class="text-secondary">{{ $chamado['idChamado'] }}</label>
                          </td>
                          <td class="">
                            <label id='tituloChamado' class="text-secondary">{{ $chamado['titulo'] }}</label>
                          </td>
                          <td class="">
                            <label id='tituloChamado' class="text-secondary">
                              {{ \Illuminate\Support\Str::limit($chamado['descricao'], 100, $end='...') }}
                            </label>
                          </td>
                          <td class="text-center">
                            <label id='tituloChamado' class="text-secondary">{{ $chamado['name'] }}</label>
                          </td>
                          <td class="text-center">
                            <label id='tituloChamado' class="text-secondary">{{ $chamado['status'] }}</label>
                          </td>
                          <td class="text-center">
                            <input value="{{ $chamado['created_at'] }}" style="text-align: center;border-color: transparent">
                          </td>
                          @if(Auth::user()->hierarquia == 2 || Auth::user()->hierarquia == 3)
                          <td>
                            <button type="button" rel="tooltip" title="" class="btn btn-warning btn-link btn-sm">
                              <a href="{{ route('chamados', ['chamadoid' => $chamado['idChamado'] ]) }}"><i class="material-icons">grading</i></a>
                            </button>
                          </td>
                          @else
                          <td>
                            <button type="button" rel="tooltip" title="" class="btn btn-warning btn-link btn-sm">
                              <a href="{{ route('chamados', ['chamadoid' => $chamado['idChamado'] ]) }}"><i class="material-icons">visibility</i></a>
                            </button>
                          </td>
                          @endif
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