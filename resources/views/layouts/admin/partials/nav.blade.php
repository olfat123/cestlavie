<header id="header_main">
    <div class="header_main_content">
        <nav class="uk-navbar">
            <!-- main sidebar switch -->
            <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                <span class="sSwitchIcon"></span>
            </a>

            <!-- secondary sidebar switch -->
            <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                <span class="sSwitchIcon"></span>
            </a>
            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav user_actions">
                    <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i
                                    class="material-icons md-24 md-light">fullscreen</i></a></li>
                    <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                        <a href="#" class="user_action_image">
                           <img class="md-user-image" src="{{asset($avatarDef)}}" alt=""/>
                        </a>
                        <div class="uk-dropdown uk-dropdown-small">
                            <ul class="uk-nav js-uk-prevent">
                                {{-- <li><a href="{{route('vendor.admin.show')}}">My profile</a></li> --}}
                                <li onclick="$('form#logout-form').submit()"><a>@lang('auth.logout')</a></li>
                            </ul>
                            <form id="logout-form" style="display: none;" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input type="hidden" name="redirect_to" value="{{route('admin.login')}}">
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>