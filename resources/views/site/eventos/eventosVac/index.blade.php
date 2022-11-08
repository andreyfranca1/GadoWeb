<!DOCTYPE html>
@include('components.head')
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
    data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

    @include('components.site.header')

    @include('components.site.sidebar')

    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-5">
                    <h4 class="page-title">Eventos de Vacinação Cadastrados</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('site.index')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Listagem de Eventos de Vacinação Cadastrados</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <button class="btn btn-primary mr-2" id="openModal" data-toggle="modal" data-target="#modalVacina"> Adicionar Vacinas</button>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>Rebanho</th>
                                    <th>Vacina</th>
                                    <th>Veterinário</th>
                                    <th>Data de aplicação</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($eventos as $evento)
                                <tr>
                                    <td>{{$evento['flock_name']}}</td>
                                    <td>{{$evento['vaccine_name']}}</td>
                                    <td>{{$evento['vet']}}</td>
                                    <td>{{date('d/m/Y h:i',strtotime($evento['date']))}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<div class="modal fade" id="modalVacina" tabindex="-1" role="dialog" aria-labelledby="modalVacinaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVacinaLabel">Inserir Novo Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('site.eventosVacinacao.novo')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="rebanho" class="col-4 col-form-label">Rebanho</label>
                        <div class="col-8">
                            <select id="rebanho" name="rebanho" class="custom-select" required="required">
                                <option selected disabled="disabled">Selecione...</option>
                                @foreach($rebanhos as $rebanho)
                                    <option value="{{$rebanho['id']}}">{{$rebanho['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="descricao" class="col-4 col-form-label">Descrição</label>
                        <div class="col-8">
                            <input id="descricao" name="descricao" type="text" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vacina" class="col-4 col-form-label">Vacina</label>
                        <div class="col-8">
                            <select id="vacina" name="vacina" class="custom-select" required="required">
                                <option selected disabled="disabled">Selecione...</option>
                                @foreach($vacinas as $vacina)
                                    <option value="{{$vacina['id']}}">{{$vacina['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lote" class="col-4 col-form-label">Lote da vacina</label>
                        <div class="col-8">
                            <input id="lote" name="lote" type="text" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="aplicacao" class="col-4 col-form-label">Tipo de aplicação</label>
                        <div class="col-8">
                            <select id="aplicacao" name="aplicacao" class="custom-select" required="required">
                                <option selected disabled="disabled">Selecione...</option>
                                <option value="Intradérmica">Intradérmica</option>
                                <option value="Subcutânea">Subcutânea</option>
                                <option value="Intramuscular">Intramuscular</option>
                                <option value="Endovenosa">Endovenosa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="vet" class="col-4 col-form-label">Veterinário</label>
                        <div class="col-8">
                            <input id="vet" name="vet" type="text" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-4 col-form-label">Data da aplicação</label>
                        <div class="col-8">
                            <input id="date" name="date" type="date" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

@include('components.footer')
