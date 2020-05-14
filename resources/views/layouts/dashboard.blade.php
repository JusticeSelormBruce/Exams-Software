<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mon School') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
	<link href="{{ asset('iCheck/flat/blue.css') }}" rel="stylesheet">
    @yield('style')

</head>
    
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    
      <!-- Main Header -->
      <header class="main-header">
    
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><i class="fa fa-fw fa-diamond"></i></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">MON SCHOOL</span>
        </a>
    
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
    
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="{{ asset('profile/default.png') }}" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                  <i class="fa fa-angle-down pull-down"></i>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="{{ asset('profile/default.png') }}" class="img-circle" alt="User Image">
    
                    <p>
                      
                      {{ Auth::user()->name }} - {{ Auth::user()->role }}

                      <small>Member since {{ Auth::user()->created_at }}</small>
                    </p>
                  </li>
                
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{ route('profile.index') }}" class="btn btn-success btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-danger btn-flat" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            Log out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                  </li>
                </ul>
              </li>
      
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
    
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
    
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ asset('profile/default.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name }}</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
    
          <!-- search form (Optional) -->
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
    
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li id="home"><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            
            <li class="treeview">
              <a href="#"><i class="fa fa-sitemap"></i> <span>Institutional Structure</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                @if(Auth::user()->role == 'superadmin')
                <li id="institutions"><a href="{{ route('institutions.index') }}"><i class="fa fa-institution"></i> <span>Institutions</span></a></li>
                @endif
                @if(Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && Auth::user()->institution->type == 'tertiary'))
                <li id="schools"><a href="{{{ route('schools.index') }}}"><i class="fa fa-building"></i> <span>Schools</span></a></li>
                <li><a href="{{ route('departments.index') }}"><i class="fa fa-home"></i> <span>Departments</span></a></li>
                <li><a href="{{ route('subjects.index') }}"><i class="fa fa-book"></i> <span>Courses</span></a></li>
                @endif
                @if(Auth::user()->role == 'superadmin' || Auth::user()->institution->type == 'tertiary')
                <li><a href="{{ route('topics.index') }}"><i class="fa fa-file"></i> <span>Topics</span></a></li>
                @endif
                @if(Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && Auth::user()->institution->type != 'tertiary'))
                <li><a href="{{ route('subject.index') }}"><i class="fa fa-book"></i> <span>Subjects</span></a></li>
                @endif
                @if(Auth::user()->role == 'superadmin' || Auth::user()->institution->type != 'tertiary')
                <li><a href="{{ route('topic.index') }}"><i class="fa fa-file"></i> <span>Topics</span></a></li>
                @endif
              </ul>
            </li>
            
            @if(Auth::user()->role == 'superadmin')
            <li class="treeview">
              <a href="#"><i class="fa fa-industry"></i> <span>School System</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('systems.index') }}"><i class="fa fa-industry"></i> <span>School System</span></a></li>
                <li><a href="{{ route('years.index') }}"><i class="fa fa-calendar"></i> <span>Years</span></a></li>
                <li><a href="{{ route('terms.index') }}"><i class="fa fa-clock-o"></i> <span>Semesters/Terms</span></a></li>
                <li><a href="{{ route('system-subjects.index') }}"><i class="fa fa-book"></i> <span>Subjects</span></a></li>
              </ul>
            </li>
            @endif
            <li class="treeview">
              <a href="#"><i class="fa fa-cogs"></i> <span>Set Question</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
              @if(Auth::user()->role == 'superadmin' || Auth::user()->institution->type == 'tertiary')
                <li><a href="{{ url('/objectives/setup') }}"><i class="fa fa-list"></i> <span>Objective Question</span></a></li>
                <li><a href="{{ url('/theories/setup') }}"><i class="fa fa-file-word-o"></i><span>Theory Question</span></a></li>
              @endif
              @if(Auth::user()->role == 'superadmin' || Auth::user()->institution->type != 'tertiary')
                <li><a href="{{ url('/objective/setup') }}"><i class="fa fa-list"></i> <span>Objective Question</span></a></li>
                <li><a href="{{ url('/theory/setup') }}"><i class="fa fa-file-word-o"></i><span>Theory Question</span></a></li>
              @endif
              </ul>
            </li>
            @if(Auth::user()->role == 'superadmin' || Auth::user()->institution->type == 'tertiary')
            <li><a href="{{ url('exam') }}"><i class="fa fa-calculator"></i> <span>Examination</span></a></li>
            @endif
            @if(Auth::user()->role == 'superadmin' || Auth::user()->institution->type != 'tertiary')
            <li><a href="{{ url('exams') }}"><i class="fa fa-calculator"></i> <span>Examination</span></a></li>
            @endif
            @if(Auth::user()->role == 'superadmin' || Auth::user()->role == 'admin')
            <li class="treeview">
              <a href="#"><i class="fa fa-users"></i> <span>Users</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
              </a>
              <ul class="treeview-menu">
                @if(Auth::user()->role == 'superadmin')
                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Administrators</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{ route('administrators.index') }}"><i class="fa fa-user"></i> <span>Administrators</span></a></li>
                <li><a href="{{ url('/assignment/institution') }}"><i class="fa fa-registered"></i><span>Institution Assignment</span></a></li>
                  </ul>
                </li>
                @endif
                <li class="treeview">
                  <a href="#"><i class="fa fa-link"></i> <span>Lecturers</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="{{ route('users.index') }}"><i class="fa fa-graduation-cap"></i><span>Lecturers/Teachers</span></a></li>
                  @if(Auth::user()->role == 'superadmin' || Auth::user()->institution->type == 'tertiary')
                  <li><a href="{{ url('/assignment/subject') }}"><i class="fa fa-certificate"></i><span>Course Assignment</span></a></li>
                  @endif
                  @if(Auth::user()->role == 'superadmin' || Auth::user()->institution->type != 'tertiary')
                  <li><a href="{{ url('/assignment/subjects') }}"><i class="fa fa-certificate"></i><span>Subject Assignment</span></a></li>
                  @endif
                  </ul>
                </li>
              </ul>
            </li>
            @endif
            <li><a href="{{ route('image.index') }}"><i class="fa fa-image"></i> <span>Images</span></a></li>
          </ul>
          <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
    
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            @yield('title')
            <small>@yield('description')</small>
          </h1>
        </section>
    
        <!-- Main content -->
        <section class="content container-fluid">
          @include('partials.success')
          @include('partials.warning')
          @yield('content')
    
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
    
      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
      </footer>
    
    </div>
    <!-- ./wrapper -->

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('DataTables/datatables.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            });

        });

    </script>
    @yield('script')
  </body>
</html>
