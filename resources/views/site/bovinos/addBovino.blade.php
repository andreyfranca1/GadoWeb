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
                    <h4 class="page-title">Adicionar Novo Bovino</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('site.index')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('site.bovinos.index')}}">Listagem de Bovinos</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
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
                    <form action="{{route('site.bovinos.adicionar')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <label for="name" class="col-form-label">Nome</label>
                                <input id="name" name="name" type="text" class="form-control" required="required">
                            </div>
                            <div class="col-3">
                                <label for="IdBrinco" class="col-form-label">ID do Brinco</label>
                                <div class="input-group">
                                    <input id="IdBrinco" name="idBrinco" type="text" class="form-control" required="required">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fa fa-folder"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <label for="idAssoc" class="col-form-label">Id da Associação</label>
                                <div class="input-group">
                                    <input id="idAssoc" name="idAssoc" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fa fa-edit"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="born_date" class="col-form-label">Data de Nascimento</label>
                                <input id="born_date" name="born_date" type="date" class="form-control" required="required">
                            </div>
                            <div class="col-3">
                                <label for="peso" class="col-form-label">Peso</label>
                                <div class="input-group">
                                    <input id="peso" name="peso" type="text" class="form-control">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fa fa-weight"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <label for="sexo" class="col-form-label">Sexo</label>

                                <select id="sexo" name="sexo" class="form-control" required="required">
                                    <option value="">Selecione</option>
                                    <option value="0">Fêmea</option>
                                    <option value="1">Macho</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="idRebanho" class="col-form-label">Rebanho</label>
                                <select id="idRebanho" name="idRebanho" class="form-control">
                                    <option value="">Selecione</option>
                                    @foreach($rebanhos as $rebanho)
                                        <option value="{{$rebanho['id']}}">{{$rebanho['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="categoria" class="col-form-label">Categoria</label>

                                <select id="categoria" name="categoria" class="form-control" required="required">
                                    <option value="">Selecione</option>
                                    <option value="Gado de corte">Gado de corte</option>
                                    <option value="Gado Leiteiro">Gado Leiteiro</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="idRaca" class="col-form-label">Raça</label>
                                <select id="idRaca" name="idRaca" class="form-control" required="required">
                                    <option value="">Selecione</option>
                                    @foreach($racas as $raca)
                                        <option value="{{$raca['id']}}">{{$raca['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <label for="idPai" class="c col-form-label">Bovino Pai</label>

                                <select id="idPai" name="idPai" class="form-control">
                                    <option value="">Selecione</option>
                                    @foreach($pais as $pai)
                                        <option value="{{$pai['id']}}">{{$pai['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="idMae" class="col-form-label">Bovino Mãe</label>

                                <select id="idMae" name="idMae" class="form-control">
                                    <option value="">Selecione</option>
                                    @foreach($maes as $mae)
                                        <option value="{{$mae['id']}}">{{$mae['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-lg btn-primary">Enviar</button>
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

</body>

@include('components.footer')
