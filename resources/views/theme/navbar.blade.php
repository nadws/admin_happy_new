@php
$user_id = Auth::user()->id;
$sub_m = DB::table('tb_sub_menu')
->where('url', Route::current()->getName())
->first();
@endphp
@if (!empty($sub_m->url))
@php
$per = DB::table('tb_permission')
->where('permission', $sub_m->id_sub_menu)
->where('id_user', $user_id)
->first();
@endphp
@endif
@if (empty($per->id_user))
<script>
    // window.location.href = '{{ route('login') }}';
</script>
@endif

<style>
    .style1 {
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 80px;
        height: 50px;
        cursor: pointer;
        margin-bottom: 10px;
        border-radius: 10px;
    }

    .card {
        background-color: <?=$warna1 ?>;
    }

    .card-header {
        background-color: <?=$warna1 ?>;
    }

    .sidebar-wrapper {
        background-color: <?=$warna1 ?>;
    }

    .btn-primary {
        --bs-btn-bg: <?=$warna3 ?>;
    }

    .sidebar-wrapper .menu .sidebar-item.active>.sidebar-link {
        background-color: <?=$warna3 ?>;
    }

    .btn-warning {
        --bs-btn-bg: <?=$warna4 ?>;
    }
</style>
{{-- permission --}}



<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('dashboard') }}">
                        admin
                    </a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#theme" class="text-sm"><i
                            class="bi bi-sliders text-sm"></i> Theme Options</a> --}}
                    <div style="display: none" class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                        <label class="form-check-label"></label>
                    </div>

                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                {{-- <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                --}}
                {{-- <li class="sidebar-item {{ Request::is('invoice') ? 'active' : '' }}">
                    <a href="{{ route('invoice') }}" class='sidebar-link'>
                        <i class="bi bi-receipt"></i>
                        <span>Data Invoice</span>
                    </a>
                </li> --}}
                {{--

                <li
                    class="sidebar-item has-sub {{ Request::is('data_pasien', 'data_dokter', 'h_pemeriksaaan') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-hospital"></i>
                        <span>Data Klinik</span>
                    </a>
                    <ul class="submenu {{ Request::is('data_pasien', 'data_dokter') ? 'active' : '' }}">
                        <li class="submenu-item {{ Request::is('data_pasien') ? 'active' : '' }}">
                            <a href="{{ route('data_pasien') }}">Data Pasien</a>
                        </li>
                        <li class="submenu-item {{ Request::is('data_dokter') ? 'active' : '' }}">
                            <a href="{{ route('data_dokter') }}">Data Dokter</a>
                        </li>
                    </ul>
                </li>
                @php
                $pertanyaan = ['pertanyaan/1', 'pertanyaan/2', 'pertanyaan/3', 'pertanyaan/4'];
                @endphp
                <li class="sidebar-item has-sub {{ Request::is($pertanyaan) ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-question"></i>
                        <span>Data Pertanyaan</span>
                    </a>
                    <ul class="submenu {{ Request::is($pertanyaan) ? 'active' : '' }}">
                        <li class="submenu-item {{ Request::is('pertanyaan/1') ? 'active' : '' }}">
                            <a href="{{ route('pertanyaan', 1) }}">Psikomotorik</a>
                        </li>
                        <li class="submenu-item {{ Request::is('pertanyaan/2') ? 'active' : '' }}">
                            <a href="{{ route('pertanyaan', 2) }}">KPSP Pada Anak</a>
                        </li>
                        <li class="submenu-item {{ Request::is('pertanyaan/3') ? 'active' : '' }}">
                            <a href="{{ route('pertanyaan', 3) }}">PEDS</a>
                        </li>
                        <li class="submenu-item {{ Request::is('pertanyaan/4') ? 'active' : '' }}">
                            <a href="{{ route('pertanyaan', 4) }}">M-Chat-R</a>
                        </li>

                    </ul>
                </li> --}}
                @php
                $id_user = Auth::user()->id;

                $sub = DB::table('tb_sub_menu')
                ->where('url', Route::current()->getName())
                ->first();
                @endphp
                @if (empty($sub->url))
                @php
                $menu = DB::select(
                "SELECT a.id_user, b.url, c.id_menu, c.icon, c.menu
                FROM tb_permission AS a
                LEFT JOIN tb_sub_menu AS b ON b.id_sub_menu = a.permission
                LEFT JOIN tb_menu AS c ON c.id_menu = b.id_menu
                WHERE a.id_user ='$id_user'
                GROUP BY b.id_menu
                order by c.urutan ASC
                ",
                );
                @endphp

                @foreach ($menu as $i => $m)
                <li class="sidebar-item has-sub {{ Request::is($m->url) ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="{{ $m->icon }}"></i>
                        <span>{{ $m->menu }}</span>
                    </a>
                    @php

                    $menu_p = DB::select(
                    DB::raw(
                    "SELECT b.id_sub_menu,a.id_user, b.url, b.sub_menu, c.id_menu, c.icon, c.menu
                    FROM tb_permission AS a
                    LEFT JOIN tb_sub_menu AS b ON b.id_sub_menu = a.permission
                    LEFT JOIN tb_menu AS c ON c.id_menu = b.id_menu
                    WHERE a.id_user ='$id_user' and b.id_menu = '$m->id_menu' ORDER BY b.urutan ASC
                    ",
                    ),
                    );

                    @endphp

                    <ul class="submenu {{ Request::is($m->url) ? 'active' : '' }}">
                        @foreach ($menu_p as $sm)
                        <li class="submenu-item {{ Request::is($sm->url) ? 'active' : '' }}">
                            <a {{ $sm->url == '#' ? 'data-bs-toggle=modal data-bs-target=#theme' : ''}}
                                href="{{ $sm->url == '#' ? '#' : route($sm->url) }}">{{ $sm->sub_menu }}</a>
                        </li>
                        @endforeach
                        {{-- <li class="submenu-item">
                            <a target="_blank" href="http://127.0.0.1:2222/dashboard">CMS Website</a>
                        </li> --}}
                    </ul>
                </li>
                @endforeach
                @else
                @php
                $menu = DB::select(
                "SELECT a.id_user, b.url, c.id_menu, c.icon, c.menu
                FROM tb_permission AS a
                LEFT JOIN tb_sub_menu AS b ON b.id_sub_menu = a.permission
                LEFT JOIN tb_menu AS c ON c.id_menu = b.id_menu
                WHERE a.id_user ='$id_user'
                GROUP BY b.id_menu
                order by c.urutan ASC
                ",
                );
                @endphp
                @foreach ($menu as $m)
                @php
                $permission2 = DB::selectOne(
                DB::raw(
                "SELECT a.id_user, a.permission, b.sub_menu, b.url, b.id_menu
                FROM tb_permission AS a
                LEFT JOIN tb_sub_menu AS b ON b.id_sub_menu = a.permission
                WHERE a.id_user ='$id_user' AND a.permission = '$sub->id_sub_menu' ORDER BY b.urutan ASC
                ",
                ),
                );

                @endphp

                <li class="sidebar-item has-sub {{ $permission2->id_menu == $m->id_menu  ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="{{ $m->icon }}"></i>
                        <span>{{ $m->menu }} </span>
                    </a>
                    @php

                    $menu_p = DB::select(
                    DB::raw(
                    "SELECT b.id_sub_menu,a.id_user, b.url, b.sub_menu, c.id_menu, c.icon, c.menu
                    FROM tb_permission AS a
                    LEFT JOIN tb_sub_menu AS b ON b.id_sub_menu = a.permission
                    LEFT JOIN tb_menu AS c ON c.id_menu = b.id_menu
                    WHERE a.id_user ='$id_user' and b.id_menu = '$m->id_menu' ORDER BY b.urutan ASC
                    ",
                    ),
                    );
                    @endphp
                    <ul class="submenu {{ $permission2->id_menu == $m->id_menu  ? 'active' : '' }}">
                        @foreach ($menu_p as $sm)
                        <li class="submenu-item {{ Request::is($sm->url) ? 'active' : '' }}">
                            <a {{ $sm->url == '#' ? 'data-bs-toggle=modal data-bs-target=#theme' : '' }}
                                href="{{ $sm->url == '#' ? '#' : route($sm->url) }}">{{ $sm->sub_menu }}</a>
                        </li>
                        @endforeach
                        {{-- <li class="submenu-item">
                            <a target="_blank" href="http://127.0.0.1:2222/dashboard">CMS Website</a>
                        </li> --}}
                    </ul>
                </li>
                @endforeach
                @endif
                {{--
                <hr>
                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class='sidebar-link'>
                        <i class="bi bi-arrow-left text-danger"></i>
                        <span>Logout</span>
                    </a>

                </li> --}}
            </ul>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $(document).ready(function() {


            $(document).on('change', '#warna2', function() {
                $('.warna2').css('background-color', $(this).val())
            })
        });
</script>
@endsection