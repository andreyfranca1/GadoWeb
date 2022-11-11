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
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">

        @include('components.site.header')

        @include('components.site.sidebar')

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Lista de Usuários</h4>
                        <h6 class="text-muted">{{$count}} Usuarios Cadastrados</h6>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('site.index')}}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <a class="btn btn-primary mr-2" href="{{route('site.usuarios.novo')}}"> Adicionar Novo Usuário</a>
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
                                    <th>E-mail</th>
                                    <th>Data de Criação</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user['name']}}</td>
                                        <td>{{$user['email']}}</td>
                                        <td>{{date('d/m/Y h:i',strtotime($user['created_at']))}}</td>
                                        <td>
                                            <div class="text-right">
{{--                                                <button type="button" class="modalBovinoShow btn btn-primary" data-bovino="{{$user['id']}}">Visualizar/Editar</button>--}}
                                                <a href="{{route('site.usuario.excluir', ['id' => $user['id']])}}" class="btn btn-confirm-exclusao btn-danger">Excluir</a>
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

</body>
    @include('components.footer')
