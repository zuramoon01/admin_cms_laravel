@props(['name', 'menu'])

@php
$navItems = [
    [
        'name' => 'product_category',
        'label' => 'Product Category',
        'data' => 'ProductCategory',
        'icon' => 'database',
        'link' => 'product-categories',
    ],
    [
        'name' => 'product',
        'label' => 'Product',
        'data' => 'Product',
        'icon' => 'hockey-puck',
        'link' => 'products',
    ],
    [
        'name' => 'voucher',
        'label' => 'Voucher',
        'data' => 'Voucher',
        'icon' => 'ticket-alt',
        'link' => 'vouchers',
    ],
    [
        'name' => 'transaction',
        'label' => 'Transaction',
        'data' => 'Transaction',
        'icon' => 'credit-card',
        'link' => 'transactions',
    ],
];
@endphp

<x-layout>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>

                    <div class="sidebar-brand-text mx-3">Admin</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Interface
                </div>

                @foreach ($navItems as $item)
                    <!-- Nav Item - {{ $item['label'] }} Collapse Menu -->
                    <li class="nav-item @if ($name === $item['name']) active @endif">
                        <a class="nav-link {{ $name === $item['name'] ? '' : 'collapsed' }}" href="#"
                            data-toggle="collapse" data-target="#collapse{{ $item['data'] }}" aria-expanded="true"
                            aria-controls="collapse{{ $item['data'] }}">
                            <i class="fas fa-fw fa-{{ $item['icon'] }}"></i>
                            <span>{{ $item['label'] }}</span>
                        </a>

                        <div id="collapse{{ $item['data'] }}"
                            class="collapse @if ($name === $item['name']) show @endif"
                            aria-labelledby="heading{{ $item['data'] }}" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">{{ $item['label'] }}:</h6>

                                <a class="collapse-item @if ($name === $item['name'] && $menu === 'edit') btn-link disabled @endif @if ($name === $item['name'] && ($menu === 'create' || $menu === 'edit')) active @endif"
                                    href="/{{ $item['link'] }}/create">
                                    {{ $name === $item['name'] && $menu === 'edit' ? 'Edit' : 'Create' }}
                                </a>

                                <a class="collapse-item @if ($name === $item['name'] && $menu === 'data') active @endif"
                                    href="/{{ $item['link'] }}/data">Data</a>
                            </div>
                        </div>
                    </li>
                @endforeach

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

                        <!-- Topbar Search -->
                        <form
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">

                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                    {{-- <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->username }}</span> --}}

                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('/img/undraw_profile.svg') }}">
                                </a>

                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        {{ $slot }}
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Admin CMS {{ date('Y') }} | Support by Zura Moon</span>
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
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <x-partials._script />
    </body>

</x-layout>
