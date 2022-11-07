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
                    <h4 class="page-title">Eventos de Alimentação Cadastrados</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('site.index')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Listagem de Eventos de Alimentação Cadastrados</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <button class="btn btn-primary mr-2" id="openModal" data-toggle="modal" data-target="#modalAlimento"> Adicionar Alimento</button>
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
                                    <th>Data de Inicio</th>
                                    <th>Data Final</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($eventos as $evento)
                                <tr>
                                    <td>{{$evento['flock_name']}}</td>
                                    <td>{{date('d/m/Y h:i',strtotime($evento['start_date']))}}</td>
                                    <td>{{date('d/m/Y h:i',strtotime($evento['end_date']))}}</td>
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
<div class="modal fade" id="modalAlimento" tabindex="-1" role="dialog" aria-labelledby="modalAlimentoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAlimentoLabel">Inserir Novo Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('site.eventosAlimentacao.novo')}}" method="post">
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
                        <label for="alimentos" class="col-4 col-form-label">Alimentos Usados</label>
                        <div class="col-8">
                            <select id="alimentos" name="alimentos[]" class="custom-select" required="required" multiple>
                                @foreach($alimentos as $alimento)
                                    <option value="{{$alimento['id']}}">{{$alimento['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start_date" class="col-4 col-form-label">Data de Inicio</label>
                        <div class="col-8">
                            <input id="start_date" name="start_date" type="date" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end_date" class="col-4 col-form-label">Data Final</label>
                        <div class="col-8">
                            <input id="end_date" name="end_date" type="date" class="form-control" required="required">
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
