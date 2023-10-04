<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register SIOPAS</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <img src="{{ asset('assets/img/8487305.jpg') }}" alt="Register Image"
                        class="col-lg-5 d-none d-lg-block">
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input id="username" class="form-control form-control-user" type="text"
                                            name="username" value="{{ old('username') }}" required autofocus
                                            autocomplete="username" placeholder="Masukan Username">
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="fullname" class="form-control form-control-user" type="text"
                                            name="fullname" value="{{ old('fullname') }}" required autofocus
                                            autocomplete="fullname" placeholder="Masukan Nama Lengkap">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input id="nip" class="form-control form-control-user" type="text"
                                            name="nip" value="{{ old('nip') }}" required autofocus
                                            autocomplete="nip" placeholder="Masukan NIP">
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="no_hp" class="form-control form-control-user" type="text"
                                            name="no_hp" value="{{ old('no_hp') }}" required autocomplete="phone"
                                            placeholder="Masukan no Telepon">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input id="divisi" class="form-control form-control-user" type="text"
                                            name="divisi" value="{{ old('divisi') }}" required autocomplete="divisi"
                                            placeholder="Masukan Divisi">
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="address" class="form-control form-control-user" type="text"
                                            name="address" value="{{ old('address') }}" required autocomplete="address"
                                            placeholder="Masukan Alamat Lengkap">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input id="email" class="form-control form-control-user" type="email"
                                        name="email" value="{{ old('email') }}" required autocomplete="username"
                                        placeholder="Alamat Email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input id="password" class="form-control form-control-user" type="password"
                                            name="password" required autocomplete="new-password"
                                            placeholder="Masukan Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="password_confirmation" class="form-control form-control-user"
                                            type="password" name="password_confirmation" required
                                            autocomplete="new-password" placeholder="Konfirmasi Password">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                <hr>
                            </form> 
                            <div class="text-center">
                                <a class="small" href="{{ url('/login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

</body>

</html>
