@include('components.login.head')

<section class="text-lg-start">

    <div class="card h-100 mb-0 p-5 schoolGreen">

        <div class="row g-0 d-flex align-items-center p-5 form-control">
            <div class="col-lg-4 d-none d-lg-flex">
                <img src="{{asset('assets/images/logo-ideau.svg')}}" alt="Gado Manager"
                     class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
            </div>
            <div class="col-lg-8">
                <div class="card-body py-5 px-md-5">
                    <div class="text-center">
                        <h1>Bem-vindo ao Gado Manager</h1>
                    </div>
                    <form action="{{route('site.login')}}" method="post">
                        @csrf
                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" value="{{old('email')}}" name="email" id="email" class="form-control" />
                            <span class="badge bg-danger">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="" for="password">Senha</label>
                            <input type="password" name="password" id="password" class="form-control" />
                            <span class="badge bg-danger">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                        </div>
                        <div class="row mb-4">
                            <div class="form-check ml-3">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"/>
                                <label class="form-check-label" for="remember"> Manter-me conectado </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mb-4 loginBtn">Entrar</button>
                    </form>
                    {{--                    <div class="col">--}}
                    {{--                        <a href="#!">Esqueceu a Senha?</a>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.footer')
