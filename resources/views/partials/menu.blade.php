@section('styles')

@endsection




<aside id="aside_menu_left" class="main-sidebar sidebar-light-danger elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar slider-content">  

        <!-- Sidebar user (optional) -->

		<div class="user-panel mt-3 pb-3 mb-3">

            @env(['dev', 'development', 'local'])
                <div class="alert alert-danger text-center ">
                    <h5><i class="icon fas fa-exclamation-triangle"></i>DEV</h5>
                </div>
            @endenv

            @env(['test', 'staging', 'qa'])
                <div class="alert alert-warning text-center">
                    <h5><i class="icon fas fa-exclamation-triangle"></i>TEST</h5>
                </div>
            @endenv

            <nav class="mt-2">

                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



                    @impersonating($guard = null)

                    <a class="btn btn-block btn-warning btn-lg" href="{{ route('impersonate.leave') }}">
                        <span class="text-danger"><i class="icon fas fa-user-friends"></i> {{ trans('global.login_as_end') }}</span>

                    </a>

                    @endImpersonating

                    <li class="nav-item has-treeview {{ request()->is("profile*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">


                            <!-- Needs to be fixed!!!!!! -->
                            @if(isset(Auth::user()->photo->thumbnail)  )
                            <img src="{{ Auth::user()->photo->thumbnail }}" class="img-circle elevation-2" alt="User Image">

                            @endif




                            <p>

                                  <p>{{ Auth::user()->firstname }} {{ Auth::user()->name }} </p>
                            </p>
                            <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                        </a>



                        <ul class="nav nav-treeview">

                                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                                    @can('profile_password_edit')
                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                                <i class="fa-fw fas fa-key nav-icon">
                                                </i>

                                                <p>
                                                    {{ trans('global.change_password') }}
                                                </p>
                                            </a>
                                        </li>
                                    @endcan
                                @endif
                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                        <p>
                                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                            </i>
                                            <p>{{ trans('global.logout') }}</p>
                                        </p>
                                    </a>
                                </li>
                        </ul>
                    </li>

                </ul>
            </nav>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('preventiefe_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/prevs*") ? "menu-open" : "" }} {{ request()->is("admin/prevregistrations*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-medkit">

                            </i>
                            <p>
                                {{ trans('cruds.preventiefe.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('prev_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.prevs.index") }}" class="nav-link {{ request()->is("admin/prevs") || request()->is("admin/prevs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-medkit">

                                        </i>
                                        <p>
                                            {{ trans('cruds.prev.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('prevregistration_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.prevregistrations.index") }}" class="nav-link {{ request()->is("admin/prevregistrations") || request()->is("admin/prevregistrations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-calendar-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.prevregistration.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('eventmenu_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/events*") ? "menu-open" : "" }} {{ request()->is("admin/eventregistrations*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon far fa-calendar-alt">

                            </i>
                            <p>
                                {{ trans('cruds.eventmenu.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('event_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.events.index") }}" class="nav-link {{ request()->is("admin/events") || request()->is("admin/events/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-calendar-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.event.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('eventregistration_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.eventregistrations.index") }}" class="nav-link {{ request()->is("admin/eventregistrations") || request()->is("admin/eventregistrations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-calendar-check">

                                        </i>
                                        <p>
                                            {{ trans('cruds.eventregistration.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('incident_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.incidents.index") }}" class="nav-link {{ request()->is("admin/incidents") || request()->is("admin/incidents/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-exclamation-triangle">

                            </i>
                            <p>
                                {{ trans('cruds.incident.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('task_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.tasks.index") }}" class="nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-tasks">

                            </i>
                            <p>
                                {{ trans('cruds.task.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }} {{ request()->is("admin/notes*") ? "menu-open" : "" }} {{ request()->is("admin/competences*") ? "menu-open" : "" }} {{ request()->is("admin/locations*") ? "menu-open" : "" }} {{ request()->is("admin/competenceregistrations*") ? "menu-open" : "" }} {{ request()->is("admin/resources*") ? "menu-open" : "" }} {{ request()->is("admin/comlogs*") ? "menu-open" : "" }} {{ request()->is("admin/user-alerts*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.management.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('note_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.notes.index") }}" class="nav-link {{ request()->is("admin/notes") || request()->is("admin/notes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-comment-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.note.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('competence_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.competences.index") }}" class="nav-link {{ request()->is("admin/competences") || request()->is("admin/competences/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-chalkboard-teacher">

                                        </i>
                                        <p>
                                            {{ trans('cruds.competence.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('location_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.locations.index") }}" class="nav-link {{ request()->is("admin/locations") || request()->is("admin/locations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-map-marker-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.location.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('competenceregistration_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.competenceregistrations.index") }}" class="nav-link {{ request()->is("admin/competenceregistrations") || request()->is("admin/competenceregistrations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-chalkboard-teacher">

                                        </i>
                                        <p>
                                            {{ trans('cruds.competenceregistration.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('resource_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.resources.index") }}" class="nav-link {{ request()->is("admin/resources") || request()->is("admin/resources/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-toolbox">

                                        </i>
                                        <p>
                                            {{ trans('cruds.resource.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('comlog_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.comlogs.index") }}" class="nav-link {{ request()->is("admin/comlogs") || request()->is("admin/comlogs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-envelope">

                                        </i>
                                        <p>
                                            {{ trans('cruds.comlog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_alert_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-bell">

                                        </i>
                                        <p>
                                            {{ trans('cruds.userAlert.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                        <i class="fas fa-fw fa-calendar nav-icon">

                        </i>
                        <p>
                            {{ trans('global.systemCalendar') }}
                        </p>
                    </a>
                </li>

                @env(['dev', 'development', 'local'])
                    <li class="nav-header">DEV TOOLS</li>
                    <li class="nav-item">
                        <a href="https://trello.com/b/1c3jyttP/osiris"  class="nav-link" target="_blank">
                            <i class="fab fa-fw fa-trello nav-icon">

                            </i>
                            <p>Trello</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://github.com/webcanyonbe/osiris"  class="nav-link" target="_blank">
                            <i class="fab fa-fw fa-github nav-icon">

                            </i>
                            <p>GitHub</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://manage.runcloud.io/servers/67294/webapplications"  class="nav-link" target="_blank">
                            <i class="fas fa-fw fa-cloud nav-icon">

                            </i>
                            <p>Runcloud</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://adminlte.io/themes/v3/"  class="nav-link" target="_blank">
                            <i class="fas fa-fw fa-palette nav-icon">

                            </i>
                            <p>AdminLTE demo</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://adminlte.io/docs/3.1//layout.html"  class="nav-link" target="_blank">
                            <i class="fas fa-fw fa-palette nav-icon">

                            </i>
                            <p>AdminLTE docs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="https://fontawesome.com/v5.15/icons?d=gallery&p=2&m=free"  class="nav-link" target="_blank">
                            <i class="fab fa-font-awesome-flag nav-icon"></i>

                            </i>
                            <p>Icons</p>
                        </a>
                    </li>
                @endenv

            </ul>
        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- /.sidebar -->
</aside>




@section('scripts')
<!-- OverlayScrollbars.js -->

<script src="{{ asset('js/overlayscrollbar.js') }}"></script>
<!-- end OverlayScrollabrs.js  -->

<script>
    $(document).ready(function () {
        var slider =  $('.slider-content');
        var overlayScrollbars = slider.overlayScrollbars({ 
            className: 'os-theme-dark',
            scrollbars : {
                visibility       : "auto",
                autoHide         : "move",
                autoHideDelay    : 800,
                dragScrolling    : true,
                clickScrolling   : false,
                touchSupport     : true,
                snapHandle       : false
            }
        }).overlayScrollbars();
        overlayScrollbars.scroll({ 
            y: '100%',
        }, 50);
    });
</script>

@endsection


