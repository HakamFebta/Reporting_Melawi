<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        {{-- <li class="menu-title" key="t-menu">Menu</li> --}}


        <li>
            <a href="{{ route('reporting.dashboard') }}">
                <i class="bx bx-home-circle"></i>
                <span key="t-dashboards">Dashboard</span>
            </a>
        </li>
        {{-- PHP IN LINE --}}
        @php
            $menus = menu();
            $sub_menus = sub_menu();
            $sub_submenu = sub_submenu();
        @endphp
        {{-- Level 0 --}}
        @foreach ($menus as $menu)
            @if ($menu->name == null && $menu->parent == null)
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-badge"></i>
                        <span key="{{ $menu->display_name }}">{{ $menu->display_name }}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        {{-- Level 1 --}}
                        @foreach ($sub_menus as $sub_menu)
                            @if ($sub_menu->parent == $menu->id_menu)
                                @if ($sub_menu->name == null)
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                                            <i class="bx bx-subdirectory-right"></i>
                                            <span
                                                key="{{ $sub_menu->display_name }}">{{ $sub_menu->display_name }}</span>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="true">
                                            {{-- Level 2 --}}
                                            @foreach ($sub_submenu as $sub_submenu1)
                                                @if ($sub_submenu1->parent == $sub_menu->id_menu)
                                                    <li>
                                                        <a href="{{ route($sub_submenu1->name) }}">
                                                            <i class="bx bx-subdirectory-right"></i>
                                                            <span
                                                                key="{{ $sub_submenu1->display_name }}">{{ $sub_submenu1->display_name }}</span>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $sub_menu->name }}">
                                            <i class="bx bx-badge-check"></i>
                                            <span
                                                key="{{ $sub_menu->display_name }}">{{ $sub_menu->display_name }}</span>
                                        </a>
                                    </li>
                                @endif
                            @else
                            @endif
                        @endforeach
                    </ul>
                </li>
            @else
                <li>
                    <a href="{{ route($menu->name) }}">
                        <i class="bx bx-badge-check"></i>
                        <span key="{{ $menu->display_name }}">{{ $menu->display_name }}</span>
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
