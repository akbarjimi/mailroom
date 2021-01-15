<div id="admin-navigation" class="z-depth-1">
    <ul class="admin-nav nav-items right hide-on-med-and-down">
        <li>
            <a href="/lettertypes">انواع نامه ها</a>
        </li>

        <li>
            <a href="projects">پروژه ها</a>
        </li>

        <li>
            <a href="letters">نامه ها</a>
        </li>

        <li>
            <a href="users">کاربران</a>
        </li>
    </ul>
    <ul class="admin-iconsx nav-icons">
        <ul>
            <li>
                <a href="" class="white-text"><i
                            class="material-icons white-text">person</i></a>
            </li>
            <li>
                <a
                        href=""
                        class="tooltipped"
                        data-tooltip="خروج"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >
                    <i class="material-icons white-text">power_settings_new</i>
                </a>
                <form id="logout-form" action="" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
        <li>
            <a><i class="material-icons toggle-show pointer white-text hide-on-large-only"
                  target=".admin-mobile, .nav-glass">menu</i></a>
        </li>
    </ul>
</div>

<ul class="admin-mobile z-depth-1 side-nav collapsible">
    <li class="user-zone">
    </li>
</ul>
<div class="nav-glass untoggle-show"></div>
