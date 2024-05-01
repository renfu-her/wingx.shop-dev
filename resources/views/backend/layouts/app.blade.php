<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>後端管理</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/backend/admin">
                    <i class="fas fa-folder"></i>
                    <span>管理者管理</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                系統管理
            </div>

            <li class="nav-item">
                <a class="nav-link" href="/backend/product">
                    <i class="fa-solid fa-folder"></i>
                    <span>產品管理</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link" href="/backend/productCategory">
                    <i class="fa-solid fa-folder"></i>
                    <span>分類管理</span>
                </a>
            </li> --}}

            <li class="nav-item">
                <a class="nav-link" href="/backend/ship">
                    <i class="fa-solid fa-folder"></i>
                    <span>運送方式管理</span>
                </a>
            </li>

            <div class="sidebar-heading">
                訂單管理
            </div>

            <li class="nav-item">
                <a class="nav-link" href="/backend/order">
                    <i class="fa-solid fa-folder"></i>
                    <span>訂單管理</span>
                </a>
            </li>

            <div class="sidebar-heading">
                內容管理
            </div>

            <li class="nav-item">
                <a class="nav-link" href="/backend/qa">
                    <i class="fa-solid fa-folder"></i>
                    <span>知識百科管理</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/backend/mail_notify">
                    <i class="fa-solid fa-folder"></i>
                    <span>Mail 樣板管理</span>
                </a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="/backend/banner">
                    <i class="fa-solid fa-folder"></i>
                    <span>Banner 管理</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/backend/policies">
                    <i class="fa-solid fa-folder"></i>
                    <span>政策管理</span>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link" href="/backend/news">
                    <i class="fa-solid fa-folder"></i>
                    <span>最新消息管理</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/backend/about-us">
                    <i class="fa-solid fa-folder"></i>
                    <span>關於我們</span>
                </a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">管理者</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/backend/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                @yield('content')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            {{-- <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer> --}}
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- alpine js -->
    <script src="//cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    @yield('js')

    @if (session()->has('message'))
        <script>
            alert("{{ session()->get('message') }}")
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            alert("{{ session()->get('error') }}")
        </script>
    @endif
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

</body>

</html>
