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
                    <h4 class="page-title">Vacinas Cadastradas</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('site.index')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Listagem de Vacinas Cadastradas</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <button class="btn btn-primary mr-2" id="openModal" data-toggle="modal" data-target="#modalVacinas"> Adicionar Nova Vacina</button>
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
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Data de Cadastro</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($vacinas as $vacina)
                                <tr>
                                    <td>{{$vacina['name']}}</td>
                                    <td>{{$vacina['description']}}</td>
                                    <td>{{date('d/m/Y h:i',strtotime($vacina['created_at']))}}</td>
                                    <td>
                                        <div class="text-right">
                                            <a href="{{route('site.vacinas.excluir', ['id' => $vacina['id']])}}" class="btn btn-confirm-exclusao btn-danger">Excluir</a>
                                        </div>
                                    </td>
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
<div class="modal fade" id="modalVacinas" tabindex="-1" role="dialog" aria-labelledby="modalVacinasLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVacinasLabel">Inserir Vacina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('site.vacinas.novo')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nomeVacina">Nome</label>
                        <input id="nomeVacina" name="nomeVacina" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea id="descricao" name="descricao" cols="40" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

</body>

@include('components.footer')
