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

    @vite(['resources/js/dash.js'])
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-5">
                    <h4 class="page-title">Dashboard</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Library</li>
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
            <div class="row d-flex justify-content-start h-1">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-success"><i class="fa-solid fa-cow"></i></span>
                            </div>
                            <span class="d-block mb-1">Gados Cadastrados</span>
                            <h2 class="mb-0">{{$metrics['cattles']}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-warning"><i class="bx bx-dock-top fs-3"></i></span>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Rebanhos Cadastrados</span>
                            <h2 class="mb-0">{{$metrics['flocks']}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-primary"><i class="bx bx-edit fs-3"></i></span>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Pesagens Nos Últimos 30 Dias</span>
                            <h2 class="mb-0">{{$metrics['weighings']}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="avatar avatar-md mx-auto mb-3">
                                <span class="avatar-initial rounded-circle bg-danger"><i class="bx bx-dock-top fs-3"></i></span>
                            </div>
                            <span class="d-block mb-1 text-nowrap">Eventos de Saúde
                                <small>Últimos 30 dias</small>
                            </span>
                            
                            <h2 class="mb-0">{{$metrics['events']}}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-4 align-self-start">
                    <div class="card">
                        <div id="chart"></div>
                    </div>
                </div>
                <div class="col-2">

                </div>

                <div class="col-6">
                    <div class="card p-5">

                        <p>Proximos Eventos de Saúde (7 dias)</p>
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            Eventos de Alimentação
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        @if (!empty($events['alimentacoes']))
                                        @foreach ($events['alimentacoes'] as $alimentacao)
                                        <div class="form-group">
                                            <p>{{$alimentacao->nomeRebanho}} <br>
                                            {{$alimentacao->descricao}} <br> {{date('d/m/Y',strtotime($alimentacao->dataInicio))}}</p>
                                        </div>
                                        <hr>
                                         @endforeach
                                        @else
                                            <p>Nenhum Evento Cadastrado!</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Eventos de Medicação
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        @if (!empty($events['medicacoes']))
                                        @foreach ($events['medicacoes'] as $medicacao)
                                        <div class="form-group">
                                            <p>{{$medicacao->nomeRebanho}} <br>
                                            {{$medicacao->descricao}} <br> {{date('d/m/Y',strtotime($medicacao->dataInicio))}}</p>
                                        </div>
                                        <hr>
                                         @endforeach
                                        @else
                                            <p>Nenhum Evento Cadastrado!</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Eventos de Vacinação
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        @if (!empty($events['vacinacoes']))
                                        @foreach ($events['vacinacoes'] as $vacinacao)
                                        <div class="form-group">
                                            <p>{{$vacinacao->nomeRebanho}} <br>
                                            {{$vacinacao->descricao}} <br> {{date('d/m/Y',strtotime($vacinacao->dataInicio))}}</p>
                                        </div>
                                        <hr>
                                        @endforeach
                                        @else
                                            <p>Nenhum Evento Cadastrado!</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12"></div>
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
