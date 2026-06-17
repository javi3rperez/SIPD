<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('images/Favicon2.png')}}" type="image/x-icon">

    <title>Bienvenido</title>

    <!-- Google Font -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE-3.2.0/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <!-- NAVBAR -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link"
                   data-widget="pushmenu"
                   href="#"
                   role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown"
                   class="nav-link dropdown-toggle"
                   href="#"
                   role="button"
                   data-bs-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false"
                   v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end"
                     aria-labelledby="navbarDropdown">

                    <a class="dropdown-item"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">

                        {{ __('Cerrar Sesión') }}

                    </a>

                    <form id="logout-form"
                          action="{{ route('logout') }}"
                          method="POST"
                          class="d-none">
                        @csrf
                    </form>

                </div>
            </li>
        </ul>
    </nav>

    <!-- SIDEBAR -->
    <aside class="main-sidebar sidebar-success-green elevation-4">

        <br>

        <!-- LOGO -->
        <div class="text-center py-3 bg-white">

            <br><br>

            <a href="{{ route('abogado.dashboard') }}">

                <img src="{{ asset('imagenes/cootranshuila.png') }}"
                     alt="Logo"
                     class="img-fluid"
                     style="
                        max-width: 200px;
                        cursor:pointer;
                        transition:0.3s;
                     "
                     onmouseover="this.style.transform='scale(1.05)'"
                     onmouseout="this.style.transform='scale(1)'">

            </a>

        </div>

        <br><br>

        <div class="sidebar">

            <!-- Sidebar Menu -->
            <nav class="mt-2">

                <ul class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview"
                    role="menu"
                    data-accordion="false">

                    <!-- SOLO COORDINADORA -->
                    @if(auth()->user()->role == 'coordinadora')

                    <li class="nav-item">

                        <a href="{{ route('coordinadora.abogados') }}"
                           class="nav-link text-dark">

                            <i class="nav-icon fas fa-gavel"></i>

                            <p>
                                Abogados
                            </p>

                        </a>

                    </li>

                    @endif

                    <br>

                    <!-- PROCESOS DISCIPLINARIOS -->
                    <li class="nav-item has-treeview">

                        <a href="#" class="nav-link text-success">

                            <i class="fas fa-balance-scale"></i>

                            &nbsp;

                            <p>
                                Procesos Disciplinarios
                                <i class="fas fa-angle-left right"></i>
                            </p>

                        </a>

                        <ul class="nav nav-treeview">

                            <!-- ESTADÍSTICAS -->
                            <li class="nav-item">

                                <a href="{{ route('abogado.estadistica') }}"
                                   class="nav-link text-dark">

                                    <i class="nav-icon fas fa-chart-bar"></i>

                                    <p>
                                        Estadística de procesos
                                        <br>
                                        Disciplinarios
                                    </p>

                                </a>

                            </li>

                            <!-- REGISTRAR -->
                            <li class="nav-item">

                                <a href="{{ route('abogado.registro') }}"
                                   class="nav-link text-dark">

                                    <i class="nav-icon fas fa-file-alt"></i>

                                    <p>
                                        Registrar Proceso
                                        <br>
                                        Disciplinario
                                    </p>

                                </a>

                            </li>

                            <!-- CONSULTAR -->
                            <li class="nav-item">

                                <a href="{{ route('abogado.consultarproceso') }}"
                                   class="nav-link text-dark">

                                    <i class="nav-icon fas fa-search"></i>

                                    <p>
                                        Consultar Proceso
                                        <br>
                                        Disciplinario
                                    </p>

                                </a>

                            </li>

                        </ul>

                    </li>

                </ul>

            </nav>

        </div>

    </aside>

    <!-- CONTENIDO -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    </aside>

    <!-- FOOTER -->
    <footer class="main-footer"
            style="
                background: #ffffff;
                border-top: 1px solid #dcdcdc;
                padding: 15px 20px;
                text-align: center;
                font-size: 14px;
                color: #374151;
            ">

        <strong style="color:#16a34a;">
            © 2026 S.I.P.D - Sistema Integral de Procesos Disciplinarios
        </strong>

        <br>

        <span>
            Desarrollado por Yony Javier Perez Timote. <br>
            Todos los derechos reservados.
        </span>

        <br>

        <small style="color:#6b7280;">
            Prohibida la reproducción o distribución total o parcial
            sin autorización previa del autor.
        </small>

    </footer>

    <!-- jQuery -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- AdminLTE -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>

    <!-- Demo -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/demo.js') }}"></script>

</body>

</html>