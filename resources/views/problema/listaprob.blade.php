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
                  <h4 class="card-title ">Problemas
                  <button type="button" rel="tooltip" title="Adicionar" class="btn btn-warning btn-link btn-sm">
                    <a href="{{route('problema') }}"><i class="material-icons">add</i></a>
                  </button>                  
                  </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-info">
                        <th class="text-center">
                          Nome 
                        </th>
                        <th class="text-center">
                          Categoria
                        </th>
                        <th class="">
                          Ações
                        </th>
                      </thead>
                      <tbody>
                        @foreach($problemas as $problema)
                        <tr>
                          <td class="text-center">
                            <label id='name' class="text-secondary">{{ $problema['name'] }}</label>
                          </td>
                          <td class="text-center">
                            <label id='categoria' class="text-secondary">{{ $problema['codigo_categoria'] }}</label>
                          </td>
                          <td>
                            <button type="button" rel="tooltip" title="" class="btn btn-warning btn-link btn-sm text-center">
                              <a href="{{ route('problema', ['problemaid' => $problema['idProblema'] ]) }}"><i class="material-icons">grading</i></a>
                            </button>
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