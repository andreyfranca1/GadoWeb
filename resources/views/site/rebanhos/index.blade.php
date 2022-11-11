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
                    <h4 class="page-title">Rebanhos Cadastrados</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('site.index')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Listagem de Rebanhos Cadastrados</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <button class="btn btn-primary mr-2" id="openModal" data-toggle="modal" data-target="#modalRebanho"> Adicionar Novo Rebanho</button>
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
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rebanhos as $rebanho)
                                <tr>
                                    <td>{{$rebanho['id']}}</td>
                                    <td>{{$rebanho['name']}}</td>
                                    <td>{{$rebanho['description']}}</td>
                                    <td>
                                        <div class="text-right">
                                            <button type="button" class="modalRebanhoShow btn btn-primary" data-rebanhoName="{{$rebanho['name']}}" data-rebanho="{{$rebanho['id']}}">Visualizar Bovinos</button>
                                            <a href="{{route('site.rebanhos.excluir', ['id' => $rebanho['id']])}}" class="btn btn-confirm-exclusao btn-danger">Excluir</a>
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
<div class="modal fade" id="modalRebanho" tabindex="-1" role="dialog" aria-labelledby="modalRebanhoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRebanhoLabel">Inserir novo Rebanho</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('site.rebanhos.novo')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="rebanhoNome">Nome</label>
                        <input id="rebanhoNome" name="name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="rebanhoDescricao">Descrição</label>
                        <textarea id="rebanhoDescricao" name="description" cols="40" rows="5" class="form-control"></textarea>
                    </div>
                    <hr>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalBovinosShow" tabindex="-1" role="dialog" aria-labelledby="modalBovinosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBovinosLabel">Bovinos Associados ao Rebanho : <span id="modalrebanhoName"></span> </h5>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-6 pl-5">
                        <div class="bovinosList">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnFechar" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.modalRebanhoShow').click(function(){
        rebanhoId = $(this).data('rebanho')
        $('#modalrebanhoName').text($(this).data('rebanhoname'))
        $.ajax({
            url: '{{route('site.bovinos.rebanho')}}',
            method: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                id: rebanhoId
            },
            success: function(response){
                listaBovinos = $('.bovinosList')
                response = JSON.parse(response)
                response.forEach(element => {
                    console.log(element);
                    listaBovinos.append('<hr>')
                    listaBovinos.append('Nome: ' + element.name + "<br>")
                    listaBovinos.append('Código do Brinco :' + element.bovine_earring_id + "<br>")
                    listaBovinos.append('Código de Associação: ' + element.association_id + "<br>")
                });
            }
        })

        $('#modalBovinosShow').modal('show')
    })

    $('#btnFechar').click(function(){
        $('.bovinosList').html('')
        $('#modalrebanhoName').text('')
        $('#modalBovinosShow').modal('hide')

    })
</script>

@include('components.footer')
