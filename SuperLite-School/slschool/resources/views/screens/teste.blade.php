@extends('layout.main')
@section('title', 'Sl-School - Página teste')
@section('content')

    <!-- Start Content -->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Cadastros</a></li>
                            <li class="breadcrumb-item active">Cadastro de ...</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Fomulário de cadastro</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Prencha os campos abaixo</h4>
                        <p class="text-muted font-14">
                            Os campos com "<span class="text-danger">*</span>" são obrigátorios
                        </p>

                        <ul class="nav nav-tabs nav-bordered mb-3">
                            <li class="nav-item">
                                <a href="#dados" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                    Dados
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#visualizar" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                    Visualizar
                                </a>
                            </li>
                        </ul>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Launch Modal
                        </button>

                        {{-- Modal --}}
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Titulo da janela Modal</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="row g-3">
                                            <div class="col-md-6">
                                                <label for="inputEmail4" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="inputEmail4">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputPassword4" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="inputPassword4">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="inputAddress"
                                                    placeholder="1234 Main St">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputAddress2" class="form-label">Address 2</label>
                                                <input type="text" class="form-control" id="inputAddress2"
                                                    placeholder="Apartment, studio, or floor">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="inputCity" class="form-label">City</label>
                                                <input type="text" class="form-control" id="inputCity">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="inputState" class="form-label">State</label>
                                                <select id="inputState" class="form-select">
                                                    <option selected>Choose...</option>
                                                    <option>...</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="inputZip" class="form-label">Zip</label>
                                                <input type="text" class="form-control" id="inputZip">
                                            </div>
                                            <div class="col-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                                    <label class="form-check-label" for="gridCheck">
                                                        Check me out
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Sign in</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Fim Modal --}}

                        <hr>

                        <div class="tab-content">
                            <div class="tab-pane" id="dados">

                                <form>
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Text</label>
                                        <input type="text" id="simpleinput" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Email</label>
                                        <input type="email" id="example-email" name="example-email"
                                            class="form-control" placeholder="Email">
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-password" class="form-label">Password</label>
                                        <input type="password" id="example-password" class="form-control"
                                            value="password">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Show/Hide Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" class="form-control"
                                                placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-palaceholder" class="form-label">Placeholder</label>
                                        <input type="text" id="example-palaceholder" class="form-control"
                                            placeholder="placeholder">
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-textarea" class="form-label">Text area</label>
                                        <textarea class="form-control" id="example-textarea" rows="5"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-readonly" class="form-label">Readonly</label>
                                        <input type="text" id="example-readonly" class="form-control" readonly=""
                                            value="Readonly value">
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-disable" class="form-label">Disabled</label>
                                        <input type="text" class="form-control" id="example-disable" disabled=""
                                            value="Disabled value">
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-static" class="form-label">Static control</label>
                                        <input type="text" readonly class="form-control-plaintext" id="example-static"
                                            value="email@example.com">
                                    </div>

                                    <div class="mb-0">
                                        <label for="example-helping" class="form-label">Helping text</label>
                                        <input type="text" id="example-helping" class="form-control"
                                            placeholder="Helping text">
                                        <span class="help-block"><small>A block of help text that breaks onto a new line
                                                and may extend beyond one line.</small></span>
                                    </div>

                                </form>
                            </div> <!-- end tab-pane -->

                            <div class="tab-pane show active" id="visualizar">
                                <h1>Teste da aba de consulta</h1>
                            </div>

                        </div> <!-- end tab-content -->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container-fluid -->

@endsection
