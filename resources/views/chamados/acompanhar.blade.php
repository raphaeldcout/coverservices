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
                        <th>
                          Código do Chamado
                        </th>
                        <th>
                          Titulo Chamado
                        </th>
                        <th>
                          Data Abertura
                        </th>
                      </thead>
                      <tbody>
                        @foreach($chamados as $chamado)
                        <tr>
                          <td>
                          {{ $chamado['id'] }}
                          </td>
                          <td>
                          {{ $chamado['titulo'] }}
                          </td>
                          <td>
                          {{ $chamado['created_at'] }}
                          </td>
                          <td>
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