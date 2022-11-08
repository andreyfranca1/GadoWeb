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
                    <h4 class="page-title">Bovinos Cadastrados</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('site.index')}}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Listagem de Bovinos</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <a class="btn btn-primary mr-2" href="{{route('site.bovinos.adicionar')}}"> Adicionar Novo Bovino</a>
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
                                    <th>ID Brinco</th>
                                    <th>Nome</th>
                                    <th>Raça</th>
                                    <th>Peso</th>
                                    <th>Rebanho</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gados as $gado)
                                <tr>
                                    <td>{{$gado['bovine_earring_id']}}</td>
                                    <td>{{$gado['name']}}</td>
                                    <td>{{$gado['breed_name']}}</td>
                                    <td>{{$gado['peso']}}</td>
                                    @if($gado['flock_name'])
                                    <td>{{$gado['flock_name']}}</td>
                                    @else
                                    <td>Sem rebanho</td>
                                    @endif
                                    <td>
                                        <div class="align-items-end pl-3">
                                            <button type="button" class="modalBovinoShow btn btn-primary" data-bovino="{{$gado['id']}}">Visualizar/Editar</button>
                                            <a href="" class="btn btn-danger">Excluir</a>
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
<div class="modal fade" id="modalBovino" tabindex="-1" role="dialog" aria-labelledby="modalBovinoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBovinoLabel">Visualizar/Editar Bovino</h5>
            </div>
            <div class="modal-body">
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
                            <input id="born_date" name="born_date" type="date" class="form-control" required="required" readonly>
                        </div>
                        <div class="col-4">
                            <label for="sexo" class="col-form-label">Sexo</label>
                            
                            <select id="sexo" name="sexo" class="form-control" required="required" disabled>
                                <option value="">Selecione</option>
                                <option value="0">Fêmea</option>
                                <option value="1">Macho</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="idRaca" class="col-form-label">Raça</label>
                            <select id="idRaca" name="idRaca" class="form-control" required="required" disabled>
                                <option value="">Selecione</option>
                                @foreach($racas as $raca)
                                <option value="{{$raca['id']}}">{{$raca['name']}}</option>
                                @endforeach
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
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h4>Histórico de Pesagens</h4>
                            <pre id="pesagemHistorico">
                                
                            </pre>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-6 align-content-end">
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-primary">Atualizar</button>
                                <button type="button" id="btnFechar" class="btn btn-lg btn-secondary">Fechar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
<script>
    $('.modalBovinoShow').click(function(){
        let idBovino = $(this).data('bovino')
        $.ajax({
            method: "POST",
            url: '{{route('site.bovinos.id')}}',
            data:{
                _token: '{{csrf_token()}}',
                id : idBovino
            },
            success : function(response) {
                response = JSON.parse(response)
                bovino = response['bovino']
                pesagem = response['pesagens']
                console.log(response);
                
                $('#name').val(bovino.name)
                $('#born_date').val(bovino.born_date)
                $('#IdBrinco').val(bovino.bovine_earring_id)
                $('#idAssoc').val(bovino.association_id)
                
                $('#sexo option[value="'+ bovino.sex +'"]').prop('selected', true)
                $('#idRaca option[value="'+ bovino.breed_id +'"]').prop('selected', true)
                $('#idRebanho option[value="'+ bovino.flock_id +'"]').prop('selected', true)
                $('#categoria option[value="'+ bovino.category + '"]').prop('selected', true)
                $('#idPai option[value="'+ bovino.father_id + '"]').prop('selected', true)
                $('#idMae option[value="'+ bovino.mother_id + '"]').prop('selected', true)


                pesagem.forEach(element => {
                    $('#pesagemHistorico').append('\n Peso: ' + element.weight + "\n Cadastrado em : " + element.data + '<br>')
                });
                
                
                $('#modalBovino').modal('show')
            }
        })
        
        
    })
    
    $('#btnFechar').click(function(){
        $('.form-control').val('')
        $('#modalBovino').modal('hide')
    })
    
</script>



@include('components.footer')
