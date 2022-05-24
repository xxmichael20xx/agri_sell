<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/paper_assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Seller panel {{ $panel_name }}
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="/paper_assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/paper_assets/css/paper-dashboard.min1036.css?v=2.1.1" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="/paper_assets/demo/demo.css" rel="stylesheet" />
  <!-- <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js" type="text/javascript"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.min.js" type="text/javascript"></script>

  <!-- Seller Custom Style -->
  <link href="{{ asset('css/seller.css') }}" rel="stylesheet">
</head>
<style>
 /* ===== Scrollbar CSS ===== */
  /* Firefox */
 /* ===== Scrollbar CSS ===== */
  /* Firefox */
  * {
    scrollbar-width: auto;
    scrollbar-color: #dedede #ffffff;
  }

  /* Chrome, Edge, and Safari */
  *::-webkit-scrollbar {
    width: 10px;
  }

  *::-webkit-scrollbar-track {
    background: #ffffff;
  }

  *::-webkit-scrollbar-thumb {
    background-color: #dedede;
    border-radius: 18px;
    border: 0px solid #ffffff;
  }

  </style>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="primary" >
      <div class="logo">
       
        <a href="" class="simple-text logo-normal pl-3">
          {{Auth::user()->shop->name}}
          <!-- <div class="logo-image-big">
            <img src="/paper_assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      
      <div class="sidebar-wrapper">
        <ul class="nav">   
          <li class="{{($panel_name == 'dashboard') ? 'active' : ''}}">
            <a href="/sellerpanel">
              <i class="nc-icon nc-shop"></i>
              <p>My shop</p>
            </a>
          </li>
     
          <li class="{{($panel_name == 'orders') ? 'active' : ''}}">
            <a href="/sellerpanel/manage_orders/pickup/1">
              <i class="nc-icon nc-tile-56"></i>
              <p>Manage orders</p>
            </a>
          </li>
          <li class="{{($panel_name == 'products') ? 'active' : ''}}">
            <a href="/sellerpanel/products">
              <i class="nc-icon nc-box"></i>
              <p>My products</p>
            </a>
          </li>
          <li class="{{ ( $panel_name == 'refunds' || $panel_name == 'refund details' ) ? 'active' : '' }}">
            <a href="/sellerpanel/refunds">
              <i class="nc-icon nc-money-coins"></i>
              <p>Refunds</p>
            </a>
          </li>
          {{-- <li class="{{($panel_name == 'pre_orders') ? 'active' : ''}}">
            <a href="/sellerpanel/pre_orders">
              <i class="nc-icon nc-box"></i>
              <p>Pre orders</p>
            </a>
          </li> --}}
        </ul>
      
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Agriseller panel</a>

          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
           
            <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link " href=""><i class="nc-icon nc-refresh-69"></i>
              </a>
            </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="javascript:location.reload(true)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-circle-10"></i>
                  <p>
                    <span class="d-lg-none d-md-block"> Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                  <a class="dropdown-item" href="/">Go to homepage</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   @csrf
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      @yield('content')
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
           
            
          </div>
        </div>
      </footer>
    </div>
  </div>
    <!--   Core JS Files   -->
    <script src="/paper_assets/js/core/jquery.min.js"></script>
  <script src="/paper_assets/js/core/popper.min.js"></script>
  <script src="/paper_assets/js/core/bootstrap.min.js"></script>
  <script src="/paper_assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="/paper_assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="/paper_assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="/paper_assets/js/plugins/sweetalert2.min.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="/paper_assets/js/plugins/jquery.validate.min.js"></script>
  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="/paper_assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="/paper_assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="/paper_assets/js/plugins/bootstrap-datetimepicker.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="/paper_assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="/paper_assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="/paper_assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="/paper_assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
  <script src="/paper_assets/js/plugins/fullcalendar/daygrid.min.js"></script>
  <script src="/paper_assets/js/plugins/fullcalendar/timegrid.min.js"></script>
  <script src="/paper_assets/js/plugins/fullcalendar/interaction.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="/paper_assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Bootstrap Table -->
  <script src="/paper_assets/js/plugins/nouislider.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="../../../buttons.github.io/buttons.js"></script>
  <!-- Chart JS -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
  <!--  Notifications Plugin    -->
  <script src="/paper_assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/paper_assets/js/paper-dashboard.min1036.js?v=2.1.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="/paper_assets/demo/demo.js"></script>
  <!-- Sharrre libray -->
  <script src="/paper_assets/demo/jquery.sharrre.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    @include('sellerPanel.additional_scripts')
    @yield('custom-scripts')
    
</body>


</html>
