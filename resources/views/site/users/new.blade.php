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
                        <h4 class="page-title">Adicionar Usuário Administrador</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('backoffice.index')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('backoffice.user.index')}}">Usuários</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Adicionar Usuário</li>
                                </ol>
                            </nav>
                        </div>
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
                        <div class="row mb-2">
                        <form action="{{route('site.usuarios.novo')}}" method="post">
                            @csrf
                            <div class="tab-content">
                                <div class="tab-pane show active" id="empresa" role="tabpanel" aria-labelledby="nav-empresa-tab">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="name" id="nameLabel">Nome Completo</label>
                                                <input id="name" name="name" type="text" required="required" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cpf" id="cpfLabel">CPF</label>
                                                <div class="input-group">
                                                    <input id="cpf" name="cpf" type="text" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="cellphone" id="cellphoneLabel">Celular</label>
                                                <div class="input-group">
                                                    <input id="cellphone" name="cellphone" type="text" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="email" id="emailLabel">E-mail</label>
                                                <div class="input-group">
                                                    <input id="email" name="email" type="email" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="password" id="passwordLabel">Senha</label>
                                                <div class="input-group">
                                                    <input id="password" name="password" type="password" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="passwordConfirm" id="passwordConfirmLabel">Confirmar Senha</label>
                                                <div class="input-group">
                                                    <input id="passwordConfirm" name="passwordConfirm" type="password" required="required" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <button class="btn btn-lg btn-primary" type="submit">Cadastrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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

@include('components.footer')
