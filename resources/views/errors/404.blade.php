<!DOCTYPE html>
<html dir="ltr">

@include('components.head')

<body>
    <div class="main-wrapper">
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
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="error-box">
            <div class="error-body text-center">
                <h1 class="error-title text-danger">404</h1>
                <h3 class="text-uppercase error-subtitle">PÁGINA NAO ENCONTRADA</h3>
                <p class="text-muted m-t-30 m-b-30">Clique abaixo para voltar para o menu principal</p>
                <a href="index.html" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">Voltar</a> </div>
        </div>

    </div>
    @include('components.footer')
</body>

</html>