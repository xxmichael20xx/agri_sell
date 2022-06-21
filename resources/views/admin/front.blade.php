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
    Admin {{$panel_name}}
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="/paper_assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/paper_assets/css/paper-dashboard.min1036.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="/paper_assets/demo/demo.css" rel="stylesheet" />
  <!-- Custom Style -->
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.7/css/fileinput-rtl.min.css" integrity="sha512-RPEs+sFuzfGVQ91quc+4MsZuQqrgev5kdXyYcfzKEYKJlrUVXzFVLkcGt0tz3MsKppbrAA8aCNxu2DB+i1/afA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.7/css/fileinput.min.css" integrity="sha512-qPjB0hQKYTx1Za9Xip5h0PXcxaR1cRbHuZHo9z+gb5IgM6ZOTtIH4QLITCxcCp/8RMXtw2Z85MIZLv6LfGTLiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0/dist/chart.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.2.7/js/fileinput.min.js" integrity="sha512-CCLv901EuJXf3k0OrE5qix8s2HaCDpjeBERR2wVHUwzEIc7jfiK9wqJFssyMOc1lJ/KvYKsDenzxbDTAQ4nh1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
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

    .bootstrap-tagsinput .tag {
      margin-right: 2px;
      color: white !important;
      background-color: #0d6efd;
      padding: 0.2rem;
    }
  </style>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger" >
      <div class="logo">
        <a href="" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="" class="simple-text logo-normal">
          {{ Auth::user()->name }}
          <!-- <div class="logo-image-big">
            <img src="/paper_assets/img/logo-big.png">
          </div> -->
        </a>
      </div>

      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="{{($panel_name == 'dashboard') ? 'active' : ''}} ">
            <a href="/admin">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>

           <li hidden class="{{($panel_name == 'notifications') ? 'active' : ''}} ">
            <a href="/admin/notifications">
              <i class="nc-icon nc-bell-55"></i>
              <p>Notifications</p>
            </a>
          </li>

          <li class="{{$panel_name == 'rider_mgmt' ? 'active' : ''}}">
              <a href="/admin/rider_management">
                <i class="nc-icon nc-box-2"></i>
              <p>Rider management</p>
              </a>
          </li>

          <li class="{{($panel_name == 'user_valid_ids') ? 'active' : ''}} ">
            <a href="/admin/valid_ids">
              <i class="nc-icon nc-badge"></i>
              <p id="verification--valid-ids">User Verification</p>
            </a>
          </li>

          <li hidden class="{{($panel_name == 'coins_top_up') ? 'active' : ''}} ">
            <a href="/admin/coins_top_up">
              <i class="nc-icon nc-money-coins"></i>
              <p>Coins top up</p>
            </a>
          </li>

          <li class="{{($panel_name == 'seller_reg_fee') ? 'active' : ''}}">
            <a href="/admin/sell_reg_fees">
              <i class="nc-icon nc-badge"></i>
              <p id="pending--shops-count">Pending shops</p>
            </a>
          </li>

          <li class="{{($panel_name == 'shops') ? 'active' : ''}}">
            <a href="/admin/manage_shops">
              <i class="nc-icon nc-shop"></i>
              <p>Approved shops</p>
            </a>
          </li>

          <li  class="{{($panel_name == 'users') ? 'active' : ''}}">
            <a href="/admin/manage_users">
              <i class="nc-icon nc-single-02"></i>
              <p>Users</p>
            </a>
          </li>

          <li  class="{{($panel_name == 'refunds') ? 'active' : ''}}">
            <a href="/admin/manage_refunds">
              <i class="nc-icon nc-money-coins"></i>
              <p id="pending--refunds">Refunds</p>
            </a>
          </li>

          <li class="{{ $panel_name == 'payout' ? 'active' : '' }}">
            <a href="/admin/payout">
              <i class="nc-icon nc-share-66"></i>
              <p id="pending--payouts">Payout</p>
            </a>
          </li>

          <li class="{{($panel_name == 'orders') ? 'active' : ''}}">
            <a href="/admin/manage_orders/pickup/1">
              <i class="nc-icon nc-tile-56"></i>
              <p>Orders monitoring</p>
            </a>
          </li>

          <li hidden class="{{($panel_name == 'products_monitoring') ? 'active' : ''}}">
            <a href="/admin/product_order_monitoring">
              <i class="nc-icon nc-tile-56"></i>
              <p>Order monitoring alt</p>
            </a>
          </li>
         
          <li class="{{($panel_name == 'products') ? 'active' : ''}}">
            <a href="/admin/manage_products">
              <i class="nc-icon nc-box"></i>
              <p>Monitor products</p>
            </a>
          </li>
           
          <li class="{{($panel_name == 'transaction_hist') ? 'active' : ''}}">
            <a href="/admin/trans_hist">
              <i class="nc-icon nc-app"></i>
              <p>Transaction history</p>
            </a>
          </li>

          <li hidden class="{{($panel_name == 'pre_orders') ? 'active' : ''}}">
            <a href="/admin/pre_orders">
              <i class="nc-icon nc-basket"></i>
              <p>Pre orders</p>
            </a>
          </li>

          {{-- <li  class="{{($panel_name == 'refund_management') ? 'active' : ''}}">
            <a href="/admin/refund_management">
              <i class="nc-icon nc-basket"></i>
              <p>Refund management</p>
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
            <a class="navbar-brand" href="javascript:;">Agrisell Admin</a>

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
                    <span class="d-lg-none d-md-block">Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                  <a class="dropdown-item" href="/admin/profile">Profile</a>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

  <script>
    (function($) {
      $(document).ready(function() {

        $('input').on('change', function (event) {
          var $element = $(event.target);
          var $container = $element.closest('.example');
    
          if ( ! $element.data( 'tagsinput' ) ) return;
    
          var val = $element.val();
          if (val === null) val = 'null';
          var items = $element.tagsinput('items');
    
          $('code', $('pre.val', $container)).html(
            $.isArray(val)
              ? JSON.stringify(val)
              : '"' + val.replace('"', '\\"') + '"'
          );
          $('code', $('pre.items', $container)).html(
            JSON.stringify($element.tagsinput('items'))
          );
        }).trigger('change');

        if ( $('#p_scents p') ) {
          var scntDiv = $('#p_scents');
          var i = $('#p_scents p').length + 1;
          
          try {
            $('#addScnt').live('click', function() {
              $('<p><label for="p_scnts"><input type="text" id="p_scnt" size="20" name="p_scnt_' + i +'" value="" placeholder="Input Value" /></label> <a href="#" id="remScnt">Remove</a></p>').appendTo(scntDiv);
              i++;
              return false;
            });
            
            $('#remScnt').live('click', function() { 
              if( i > 2 ) {
                $(this).parents('p').remove();
                i--;
              }
              return false;
            });
            
          } catch (error) {
            
          }
        }

        const user_id = {{ Auth::check() ? Auth::user()->id : NULL }} 
        let pusher = new Pusher( 'd527cc315432ec685113', {
          cluster: 'ap1'
        } )
        getPendingShopCount()
        getValidIdsForVerification()
        getPendingRefunds()
        getPendingPayouts()

        var channel = pusher.subscribe( 'my-channel' )

        /**
        * Get the updated notifications count via GET Request on API Routes
        * Updates the count in the header's notification content
        */
        function getPendingShopCount() {
          try {
            const selector = `#pending--shops-count`
            $.post( `/api/admin/pending/shops`, { user_id: user_id }, function( res ) {
              if ( res.success ) {
                const count = res.data
                const badge = `
                  Pending shops <span class="badge badge-primary">${count}</span>
                `
                $( selector ).html( badge )

              } else {
                $( selector ).html( `Pending shops` )
              }
            } )
              
          } catch (error) { /* silently exit */ }
        }

        /**
        * Get the count of valid ids for verification
        */
        function getValidIdsForVerification() {
          try {
            const selector = `#verification--valid-ids`
            $.post( `/api/admin/verification/ids`, { user_id: user_id }, function( res ) {
              if ( res.success ) {
                const count = res.data
                const badge = `
                  User Verification <span class="badge badge-primary">${count}</span>
                `
                $( selector ).html( badge )

              } else {
                $( selector ).html( `User Verification` )
              }
            } )
              
          } catch (error) { /* silently exit */ }
        }

        /**
        * Get the updated notifications count via GET Request on API Routes
        * Updates the count in the header's notification content
        */
        function getPendingRefunds() {
          try {
            const selector = `#pending--refunds`
            $.post( `/api/admin/pending/refunds`, { user_id: user_id }, function( res ) {
              if ( res.success ) {
                const count = res.data
                const badge = `
                  Refunds <span class="badge badge-primary">${count}</span>
                `
                $( selector ).html( badge )

              } else {
                $( selector ).html( `Refunds` )
              }
            } )
              
          } catch (error) { /* silently exit */ }
        }

        /**
        * Get the updated notifications count via GET Request on API Routes
        * Updates the count in the header's notification content
        */
        function getPendingPayouts() {
          try {
            const selector = `#pending--payouts`
            $.post( `/api/admin/pending/payouts`, { user_id: user_id }, function( res ) {
              if ( res.success ) {
                const count = res.data
                const badge = `
                  Payout <span class="badge badge-primary">${count}</span>
                `
                $( selector ).html( badge )

              } else {
                $( selector ).html( `Payout` )
              }
            } )
              
          } catch (error) { /* silently exit */ }
        }

      })

    })(jQuery)
  </script>
  @include('admin.additional_scripts')
  @yield('admin.custom_scripts')
</body>
</html>
