@extends('themes.cooladmin')
@section('themecontent')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show fixed-top m-t-75 text-center" role="alert">
            <strong>Hore!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('fail'))
        <div class="alert alert-danger alert-dismissible fade show fixed-top m-t-75 text-center" role="alert">
            <strong>Oh, no!</strong> {{ session('fail') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('logo.png') }}" alt="Cool Admin"/>
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                @include('admin.layout.menus')
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="#">
                                    <img src="{{ asset('logo.png') }}" alt="CoolAdmin"/>
                                </a>
                            </div>
                            <div class="header-button2">
                                <div class="header-button-item mr-0 js-sidebar-btn hide-lg">
                                    <i class="zmdi zmdi-menu"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <a href="#">
                        <img src="{{ asset('logo.png') }}"
                             alt="Cool Admin"/>
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    @include('admin.layout.menus')
                </div>
            </aside>
            <!-- END HEADER DESKTOP-->
            <section class="m-t-75 p-t-55">
                @yield('content')
            </section>

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a
                                            href="https://colorlib.com">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
@endsection