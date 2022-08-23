@include('components.login.head')

  <section class="text-lg-start">
    <style>
      .verdeBosta {
        background-color: #006635
      }
      .rounded-t-5 {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
      }
  
      @media (min-width: 992px) {
        .rounded-tr-lg-0 {
          border-top-right-radius: 0;
        }
  
        .rounded-bl-lg-5 {
          border-bottom-left-radius: 0.5rem;
        }
      }
    </style>
    <div class="card h-100 mb-0 p-5 verdeBosta">

      <div class="row g-0 d-flex align-items-center p-5 form-control">
        <div class="col-lg-4 d-none d-lg-flex">
          <img src="{{asset('assets/images/logo-ideau.svg')}}" alt="Gado Manager"
            class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />
        </div>
        <div class="col-lg-8">

          <div class="card-body py-5 px-md-5 form-control">
            <div class="text-center">
              <h1>Login</h1>
            </div>
            <form>
              <!-- Email input -->
              <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Email</label>
                <input type="email" id="form2Example1" class="form-control" />
              </div>
  
              <!-- Password input -->
              <div class="form-outline mb-4">
                <label class="" for="form2Example2">Senha</label>
                <input type="password" id="form2Example2" class="form-control" />
              </div>
  
              <!-- 2 column grid layout for inline styling -->
              <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                  <!-- Checkbox -->
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                    <label class="form-check-label" for="form2Example31"> Manter-me conectado </label>
                  </div>
                </div>

              </div>
  
              <!-- Submit button -->
              <button type="button" class="btn btn-primary btn-block mb-4">Login</button>
  
            </form>
                
            <div class="col">
              <!-- Simple link -->
              <a href="#!">Esqueceu a Senha?</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  @include('components.footer')
