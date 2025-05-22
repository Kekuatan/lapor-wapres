<div>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href={{route('dashboard')}} class="brand-link">

            <img src="{{asset('/svg/bc_logo.svg')}}" alt="Logo" class="brand-image img-square "
                 style="opacity: .8; width: 230px">
            <span class="brand-text font-weight-light ">.</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    {{--                    <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">--}}
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    @foreach($menus as $menu)
                        <li class="nav-item {{$selected == $menu['id'] ? 'menu-is-opening menu-open' : ''}}">
                            @if($menu['sub_menus'] ?? false)
                                <a href="{{$menu['url']}}"
                                   class="nav-link {{$selected == $menu['id'] ? 'active' : ''}}" >
                                    <i class="nav-icon {{$menu['icon']}}"></i>
                                    <p>
                                        {{$menu['label']}}
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                            @else
                                <a href="{{$menu['url']}}"
                                   wire:click.prevent="setSelected('{{ $menu['id'] }}')"
                                   wire:navigate

                                   class="nav-link {{$selected == $menu['id'] ? 'active' : ''}}" >
                                    <i class="nav-icon {{$menu['icon']}}"></i>
                                    <p>
                                        {{$menu['label']}}
                                        {{--                                        <span class="right badge badge-danger">{{$selectedSubMenu . $menu['id']}}</span>--}}
                                    </p>
                                </a>
                            @endif


                            @if($menu['sub_menus'] ?? false)
                                <ul class="nav nav-treeview" style="display: {{ $selected == $menu['id'] ? 'block' : 'none'}}">
                                    @foreach($menu['sub_menus'] as $subMenu)
                                        <li class="nav-item">
                                            <a
                                                href="{{$subMenu['url']}}"
                                                wire:navigate
                                                wire:click.prevent="setSelectedSubMenu('{{$menu['id']}}', '{{$subMenu['id'] }}')"
                                                class="nav-link {{$selectedSubMenu == $subMenu['id'] ? 'active' : ''}}">
                                                <i class="{{$subMenu ['icon']}} nav-icon"></i>
                                                <p>{{$subMenu['label']}}</p>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                        </li>

                    @endforeach
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
