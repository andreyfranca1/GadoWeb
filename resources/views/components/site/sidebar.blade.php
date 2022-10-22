<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User Profile-->
                    <div class="user-profile d-flex no-block dropdown m-t-20">
                        <div class="user-content hide-menu m-l-10">
                            <a href="javascript:void(0)" class="" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="m-b-0 user-name font-medium">Steave Jobs </h5>
                                <span class="op-5 user-email">varun@gmail.com</span>
                            </a>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('site.index')}}" aria-expanded="false"><i class="fas fa-home"></i><span class="hide-menu">Tela inicial</span></a></li>
                <li class="dropdown sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-cow"></i><span class="hide-menu">Bovinos</span></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item sidebar-link" href="{{route('site.bovinos.listar')}}"><i class="mdi mdi-cow"></i>Bovinos</a></li>
                        <li><a class="dropdown-item sidebar-link" href="{{route('site.rebanhos.listar')}}"><i class="mdi mdi-bell-outline"></i>Rebanhos</a></li>
                        <li><a class="dropdown-item sidebar-link" href="{{route('site.pesagens.listar')}}"><i class="mdi mdi-weight-kilogram"></i>Pesagens</a></li>
                    </ul>
                </li>
                <li class="dropdown sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-playlist-plus"></i><span class="hide-menu">Cadastros Adicionais</span></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item sidebar-link" href="{{route('site.alimentos.listar')}}"><i class="mdi mdi-food"></i>Alimentos</a></li>
                        <li><a class="dropdown-item sidebar-link" href="{{route('site.medicamentos.listar')}}"><i class="fas fa-capsules"></i>Medicamentos</a></li>
                        <li><a class="dropdown-item sidebar-link" href="{{route('site.vacinas.listar')}}"><i class="fas fa-syringe"></i>Vacinas</a></li>
                    </ul>
                </li>
                <li class="dropdown sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false"><i class="far fa-calendar-alt"></i><span class="hide-menu">Eventos</span></a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item sidebar-link" href="#"><i class="mdi mdi-food"></i>Eventos de Alimentação</a></li>
                        <li><a class="dropdown-item sidebar-link" href="#"><i class="fas fa-capsules"></i>Eventos de Medicação</a></li>
                        <li><a class="dropdown-item sidebar-link" href="#"><i class="fas fa-syringe"></i>Eventos de Vacinação</a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('backoffice.user.index')}}" aria-expanded="false"><i class="fas fa-users"></i><span class="hide-menu">Usuários</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('site.logout')}}" aria-expanded="false"><i class="fa fa-power-off m-r-5 m-l-5"></i><span>Sair</span></a></li>
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
