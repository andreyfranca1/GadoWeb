<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('dist/js/app-style-switcher.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('dist/js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset('dist/js/custom.js')}}"></script>
<!--This page JavaScript -->
<!--chartis chart-->
<script src="{{asset('assets/libs/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
<script src="{{asset('dist/js/pages/dashboards/dashboard1.js')}}"></script>

<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $('.tel').mask('(99)9999-9999')
    $('.cel').mask('(99)99999-9999')
    $('.cpf').mask('999.999.999-99')

    $(document).ready(function(){
        setTimeout(() => {
            $('#liveToast').fadeOut()
        }, 5000);
    })

    $(document).ready(function(){
        $(".preloader").fadeOut();
        $('#dataTable').DataTable({
            language: {
                url : '//cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
            }
        });
    })

    $('a.btn-confirm-exclusao').confirm({
        title: "ATENÇÃO",
        content: "Deseja realmente realizar a exclusão?",
        type: 'red',
        buttons: {
            Confirmar: {
                btnClass: 'btn-red',
                action: function() {
                    location.href = this.$target.attr('href');
                }
            },
            Cancelar: function (){}
        }
    });
</script>
