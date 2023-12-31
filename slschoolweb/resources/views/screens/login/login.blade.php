<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Login - Sl-School</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/bootstrap-login-form.min.css" />
</head>

<body>
  <!-- Start your project here-->

  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }
    .h-custom {
      height: calc(100% - 73px);
    }
    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
  </style>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="/img/login/login.jpg" class="img-fluid"
            alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 card border p-4">

      @if(isset($msg))

          <div class="alert alert-warning alert-dismissible fade show msg d-flex
            justify-content-between align-items-end mb-3" role="alert" style="text-align: center;">
              <h5>{{$msg}} </h5>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

          </div>
          
      @endif

      @error('error')
        <span style="color: red" class="p-2">{{ $message }}</span>
      @enderror

          <form action="{{route('login.login')}}" method="post">
           
            @csrf

           <div class="mb-4">
                @error('username')
                <span>{{ $message }}</span>
                @enderror
                <label for="username" class="form-label">Usuário</label>
                <input type="text" class="form-control" name="username" id="username" maxlength="255" required>
           </div>

           <div class="mb-4">
                @error('password')
                <span>{{ $message }}</span>
                @enderror
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" name="password" id="password" maxlength="255" required>
           </div>

            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <a href="#!" class="text-body">Esqueceu sua senha?</a>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;">Entrar</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
      <!-- Copyright -->
      <div class="text-white mb-3 mb-md-0">
       <p> Criosoftware Sistemas {{date('d/m/Y', strtotime(\Carbon\Carbon::now()->format('Y-m-d')))}}</p>
      </div>
      <!-- Copyright -->

      <!-- Right -->
    </div>
  </section>
  <!-- End your project here-->

  <!-- MDB -->
  <script type="text/javascript" src="/js/mdb.min.js"></script>
  
</body>

</html>