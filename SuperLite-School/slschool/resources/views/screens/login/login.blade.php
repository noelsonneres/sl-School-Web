<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Realizar login no Sl-School</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        
        <!-- Theme Config Js -->
        <script src="assets/js/hyper-config.js"></script>

        <!-- App css -->
        <link href="assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    </head>
    
    <body class="authentication-bg position-relative" style="background: #dedddd">

        <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xxl-4 col-lg-5">
                        <div class="card">

                            <!-- Logo -->
                            <div class="card-header py-4 text-start bg-secondary">
                                <a href="index.html">
                                    <span><img src="assets/images/free-logo.png" alt="logo" height="50"></span>
                                </a>
                            </div>

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <h4 class="text-dark-50 text-center pb-0 fw-bold">Login</h4>
                                    <h5 class="text-end">Sl-School</h5>
                                    <p class="text-muted mb-4">Entre com o seu nome de usuário e senha</p>
                                </div>

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

                                <form action="{{route('login.login')}}" method="POST">

                                    @csrf

                                    <div class="mb-3">
                                        @error('username')
                                        <span>{{ $message }}</span>
                                        @enderror
                                        <label for="username" class="form-label">Nome de usuário</label>
                                        <input class="form-control" type="text" name="username" id="username" 
                                            required="" placeholder="Digite o seu usuário para entrar">
                                    </div>

                                    <div class="mb-3">
                                        @error('password')
                                        <span>{{ $message }}</span>
                                        @enderror                                        
                                        <label for="password" class="form-label">Senha</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" id="password" class="form-control" 
                                                placeholder="Entre com sua senha" autocomplete="off">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 mb-0 text-center">
                                        <button class="btn btn-success" type="submit"> Entrar </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> © SeabraSoftware - seabrasoft.com.br
        </footer>
        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>
        
        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

    </body>
</html>