<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a{{ (Request::is('admin') ? ' class="active"' : '') }} href="/admin"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li{{ ((Request::is('admin/blogs*') || Request::is('admin/categories*')) ? ' class="active"' : '') }}>
                <a{{ (Request::is('admin/blogs*') ? ' class="active"' : '') }} href="#"><i class="fa fa-newspaper-o fa-fw"></i> Posts<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::to('admin/blogs') }}">All Posts</a>
                    </li>
                    <li>
                        <a href="{{ route('create/blog') }}">Add New</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('admin/categories') }}">Categories</a>
                    </li>
                    <li>
                        <a href="#">Tags</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-picture-o fa-fw"></i> Medias<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="flot.html">Flot Charts</a>
                    </li>
                    <li>
                        <a href="morris.html">Morris.js Charts</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
            </li>
            <li>
                <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
            </li>
            <li{{ ((Request::is('admin/users*') || Request::is('admin/group*')) ? ' class="active"' : '') }}>
                <a{{ ((Request::is('admin/users*') || Request::is('admin/group*')) ? ' class="active"' : '') }} href="#"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL::to('admin/users') }}">All Users</a>
                    </li>
                    <li>
                        <a href="{{ route('create/user') }}">Add News</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('admin/groups') }}">User Groups</a>
                    </li>
                    <li>
                        <a href="#">Your Profile</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="panels-wells.html">Panels and Wells</a>
                    </li>
                    <li>
                        <a href="buttons.html">Buttons</a>
                    </li>
                    <li>
                        <a href="notifications.html">Notifications</a>
                    </li>
                    <li>
                        <a href="typography.html">Typography</a>
                    </li>
                    <li>
                        <a href="grid.html">Grid</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="blank.html">Blank Page</a>
                    </li>
                    <li>
                        <a href="login.html">Login Page</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a{{ (Request::is('settings') ? ' class="active"' : '') }} href="#"><i class="fa fa-cogs fa-fw"></i></i> Settings</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->