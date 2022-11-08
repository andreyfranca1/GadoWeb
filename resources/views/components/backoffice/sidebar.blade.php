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
                                <h5 class="m-b-0 user-name font-medium">{{session()->get('userNameAdmin')}}</h5>
                                <span class="op-5 user-email">{{session()->get('userEmailAdmin')}}</span>
                            </a>
                        </div>
                    </div>
                    <!-- End User Profile-->
                </li>
                <!-- User Profile-->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('backoffice.index')}}" aria-expanded="false"><i class="fas fa-home"></i><span class="hide-menu">Tela inicial</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('backoffice.company.index')}}" aria-expanded="false"><i class="fas fa-building"></i><span class="hide-menu">Empresas</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('backoffice.user.index')}}" aria-expanded="false"><i class="fas fa-users"></i><span class="hide-menu">Usuários</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('backoffice.logout')}}" aria-expanded="false"><i class="fa fa-power-off m-r-5 m-l-5"></i><span>Sair</span></a></li>
            </ul>

        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

@if (!empty($errors->all()))
    <div class="position-fixed top-0 end-0 p-3 mt-5" style="z-index: 11">
        <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="fas fa-times mr-1" style="color: red"></i>
                <strong class="me-auto"> Gado Manager</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        </div>
    </div>
@endif
