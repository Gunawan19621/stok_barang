<!DOCTYPE html>
<html lang="en">
<title>@yield('title')</title>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SIOPAS - Dashboard</title>
    @include('layouts.link')
</head>

<body id="page-top">
    @stack('style')
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('layouts.navbar')

                <!-- Begin Page Content -->
                <!-- <div class="container-fluid"> -->
                <!-- allert update data foto -->
                @if (session()->has('success'))
                    <div id="success-alert" class="alert alert-success floating-alert">
                        {{ session()->get('success') }}
                    </div>
                @elseif(session()->has('error'))
                    <div id="error-alert" class="alert alert-danger floating-alert">
                        X {{ session()->get('error') }}
                    </div>
                @endif
                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger" style="cursor: pointer" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.script')

    <!-- pengaturan datatables -->
    <script>
        $(document).ready(function() {
            $('#tablebarang').DataTable({
                "searching": true // Aktifkan fitur pencarian
            });
        });
    </script>
    <!-- End pengaturan datatables -->

    <!-- Batas waktu alert -->
    <script>
        // Hapus alert setelah 3 detik
        setTimeout(function() {
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.remove();
            }
        }, 3000); // 3000 milidetik = 3 detik
    </script>
    <!-- Batas waktu alert -->

    <!-- update data foto -->
    <script>
        $(document).ready(function() {
            $('#photo').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('.profile-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('.profile-image').click(function() {
                $('.form-control-file').click();
            });
        });
    </script>
    <!-- End update data foto -->
</body>

</html>
