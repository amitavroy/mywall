<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{Auth::user()->present()->avatar}}" class="img-circle user-pic" alt="User Image">
            </div>
            <div class="pull-left info">
                <p class="display-name">{{Auth::user()->present()->displayName}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
    <span class="input-group-btn">
      <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
      </button>
  </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ Request::is('/') ? 'active open' : ''  }}">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @permission('manage-role-perm')
            <li class="treeview {{ Request::is('permissions*') ? 'active' : ''  }}">
                <a href="javascript:;">
                    <i class="fa fa-user"></i> <span>Roles &amp; Permissions</span> <i
                        class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('permissions/manage-roles') ? 'active' : ''  }}">
                        <a href="{{route('roles.view')}}"><i class="fa fa-circle-o"></i> Manage Role</a>
                    </li>
                    <li class="{{ Request::is('permissions/manage-permission') ? 'active' : ''  }}">
                        <a href="{{route('permission.list')}}"><i class="fa fa-circle-o"></i> Manage Permissions</a>
                    </li>
                    <li class="{{ Request::is('permissions/permission-matrix') ? 'active' : ''  }}">
                        <a href="{{route('permission.list')}}"><i class="fa fa-circle-o"></i> Permission Matrix</a>
                    </li>
                </ul>
            </li>
            @endpermission

            @permission('manage-users')
            <li class="treeview {{ Request::is('users/*') ? 'active' : ''  }}">
                <a href="javascript:;">
                    <i class="fa fa-users"></i> <span>Manage Users</span> <i
                        class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('users/add') ? 'active' : ''  }}">
                        <a href="{{route('user.add')}}"><i class="fa fa-circle-o"></i> Add user</a>
                    </li>
                    <li class="{{ Request::is('users/list') ? 'active' : ''  }}">
                        <a href="{{route('user.list')}}"><i class="fa fa-circle-o"></i> View users</a>
                    </li>
                </ul>
            </li>
            @endpermission
            <li>
                <a href="pages/calendar.html">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                    <small class="label pull-right bg-red">3</small>
                </a>
            </li>
            <li>
                <a href="pages/mailbox/mailbox.html">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <small class="label pull-right bg-yellow">12</small>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
