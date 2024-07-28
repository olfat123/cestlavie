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
            
            
            @if($authUser->can('view_dashboard'))
                <li class="@if(request()->is('*admin/configurations*')) current_section @endif" title="Configurations">
                    <a href="{{route('config.manager.index')}}">
                        <span class="menu_icon"><i class="material-icons">settings</i></span>
                        <span class="menu_title">Configurations</span>
                    </a>
                </li>
            @endif

            @if($authUser->can('view_dashboard'))
                <li class="@if(request()->is('*admin/settings*')) current_section @endif" title="Settings">
                    <a href="{{route('setting.manager.index')}}">
                        <span class="menu_icon"><i class="material-icons">settings</i></span>
                        <span class="menu_title">Settings</span>
                    </a>
                </li>
            @endif
           
            @if($authUser->can('view_dashboard'))               
                <li class="@if(request()->is('*countries*')) current_section @endif" >
                    <a href="{{route('country.manager.index')}}">
                        <span class="menu_icon"><i class="material-icons">security</i></span>
                        <span class="menu_title">Countries</span>
                    </a>
                </li>
            @endif 
            
            @if($authUser->can('view_manual'))             
                <li class="@if(request()->is('*manual-messages*')) current_section @endif" >
                    <a href="{{route('manualMessage.manager.index')}}">
                        <span class="menu_icon"><i class="material-icons">security</i></span>
                        <span class="menu_title">Manual Messages</span>
                    </a>
                </li>
            @endif
            @if($authUser->can('view_dashboard'))             
                <li class="@if(request()->is('*wmessages*')) current_section @endif" >
                    <a href="{{route('wMessage.manager.index')}}">
                        <span class="menu_icon"><i class="material-icons">security</i></span>
                        <span class="menu_title">Weekly Messages</span>
                    </a>
                </li>
            @endif
            @if($authUser->can('view_dashboard'))             
                <li class="@if(request()->is('*wverses*')) current_section @endif" >
                    <a href="{{route('wVerse.manager.index')}}">
                        <span class="menu_icon"><i class="material-icons">security</i></span>
                        <span class="menu_title">Weekly Verses</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</aside>