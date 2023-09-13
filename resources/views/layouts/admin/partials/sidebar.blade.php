<aside id="sidebar_main">

    <div class="sidebar_main_header">
        <div class="sidebar_logo">
            <a href="{{route('admin.dashboard')}}" class="sSidebar_hide sidebar_logo_large" style="padding-top:10px;">
                <img class="logo_regular" src="{{asset('assets/images/icons/logo-white.png')}}" alt=""
                     width="150"/>
            </a>
        </div>
    </div>

    <div class="menu_section">
        <ul>
            <li title="Dashboard" class="@if(request()->is('*admin')) current_section @endif">
                <a href="{{route('admin.dashboard')}}">
                    <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                    <span class="menu_title">Dashboard</span>
                </a>
            </li>
            
            
            {{-- @if($authUser->can('view_dashboard'))
                <li class="@if(request()->is('*admin/users*')) current_section @endif" title="Users">
                    <a href="{{route('user.admin.index')}}">
                        <span class="menu_icon"><i class="material-icons">group</i></span>
                        <span class="menu_title">Customers</span>
                    </a>
                </li>
            @endif --}}
            {{-- @if($authUser->can('view_dashboard'))
                
                <li class="@if(request()->is('*admins*')) current_section @endif" >
                    <a href="{{route('management.admin.user.index')}}">
                        <span class="menu_icon"><i class="material-icons">security</i></span>
                        <span class="menu_title">Managers</span>
                    </a>
                </li>
            @endif --}}
            
           
        </ul>
    </div>
</aside>
