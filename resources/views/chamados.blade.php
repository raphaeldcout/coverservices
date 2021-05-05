                @extends('layouts.master')
                @section('conteudo')
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header"><h3>Abertura de Chamados</h3></div>
                            <form method="POST" action="{{route('cadastrar_chamado')}}" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="validationTextarea">Titulo</label>
                                        <input class="form-control" maxlength="50" id="titulo" name="titulo" placeholder="Required example textarea" required>
                                    </div>

                                    <div class="form-group">
                                        <select class="custom-select" name="status" id="status" required>
                                            <option value="">Status do Chamado</option>
                                            <option value="1">Ativo</option>
                                            <option value="2">Pendente</option>
                                            <option value="3">Encerrado</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select class="custom-select" name="urgencia" id="urgencia" required>
                                            <option value="">Nível de Urgencia</option>
                                            <option value="1">Baixo</option>
                                            <option value="2">Médio</option>
                                            <option value="3">Alto</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select class="custom-select" name="prioridade" id="prioridade" required>
                                            <option value="">Nível de prioridade</option>
                                            <option value="1">Baixo</option>
                                            <option value="2">Médio</option>
                                            <option value="3">Alto</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="validationTextarea">Resumo</label>
                                        <textarea class="form-control" id="resumo" maxlength="100" name="resumo" placeholder="Escreva um resumo breve" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="validationTextarea">Descrição</label>
                                        <textarea class="form-control" id="titulo" name="titulo" placeholder="Descreva o problema" required></textarea>
                                    </div>

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="anexo" name="anexo" required>
                                        <label class="custom-file-label" for="validatedCustomFile">Escolha o documento...</label>
                                    </div>
                                <div style="margin-top: 10px; text-align: center">
                                    <button class="btn btn-primary" type="submit">Enviar chamado</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endsection
                @section('scripts')
                    {{--<script src="/js/core/jquery.min.js"></script>--}}
                @endsection
