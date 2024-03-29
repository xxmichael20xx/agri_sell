<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Agrisell</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.png">

    <!-- all css here -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/assets/css/animate.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/themify-icons.css">
    <link rel="stylesheet" href="/assets/css/pe-icon-7-stroke.css">
    <link rel="stylesheet" href="/assets/css/icofont.css">
    <link rel="stylesheet" href="/assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="/assets/css/bundle.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/responsive.css">


    @livewireStyles

    <script src="/assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<style>
    .categories-search-wrapper {
        background-color: #d1e9bb;
        border-radius: 5px;
    }

    .category-heading > h3 {
        background-color: #35b971;
    }

    .categories-wrapper button {
        border-style: none none none none;
    }

    @media (max-width: 767px) {
        .categories-wrapper {
            border-top: 0;
            margin-top: 0;
            padding-top: 0;
        }
    }
    * {
    scrollbar-width: auto;
    scrollbar-color: #dedede #ffffff;
  }

/* ===== Scrollbar CSS ===== */
  /* Firefox */
 /* ===== Scrollbar CSS ===== */
  /* Firefox */
  * {
    scrollbar-width: auto;
    scrollbar-color: #22bf6e #ffffff;
  }

  /* Chrome, Edge, and Safari */
  *::-webkit-scrollbar {
    width: 10px;
  }

  *::-webkit-scrollbar-track {
    background: #ffffff;
  }

  *::-webkit-scrollbar-thumb {
    background-color: #22bf6e;
    border-radius: 0px;
    border: 0px solid #ffffff;
  }


</style>

<body>
<!-- Messenger Chat plugin Code -->
<div id="fb-root"></div>

<!-- Your Chat plugin code -->
<div id="fb-customer-chat" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "113303357799567");
  chatbox.setAttribute("attribution", "biz_inbox");

  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v12.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
<header>
    <div class="header-top-wrapper-2 border-bottom-2 bg-success text-white">
        <div class="header-info-wrapper pl-200 pr-200">
            <div class="header-contact-info text-white">
                <ul>

                    @guest
                        <li><a href="#" class="text-white">Welcome Guest</a></li>
                    @else
                    @if(Auth::user()->email_verified_at == NULL || Auth::user()->email_verified_at == '')
                                    <script>window.location = "/verify";</script>
                                @endif
                            @if(Auth::user()->IsdefaultPassword == '1')
                                <script>window.location = "/change-password";</script>
                            @endif
                             
                        <li><a href="/user_home" class="text-white">Welcome {{ Auth::user()->email }}</a></li>
                        
                    @endguest
                </ul>
            </div>
            <div class="electronics-login-register">
                <ul>


                    @guest
                        @if (Route::has('login'))
                            <li>
                                <a class="text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li>
                                <a class="text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                    {{--agri coins value --}}
                   
                    {{-- end of ag coins val --}}

                        @if (Auth::user()->role_id == '3')
                            <li><a class="text-white" href="/sellerpanel">Seller panel
                                </a></li>

                        @endif

                        @if (Auth::user()->role_id == '1')
                            <li><a class="text-white" href="/admin">Admin panel
                                </a></li>
                        @endif

                            @if (Auth::user()->role_id == '4')
                                <li><a class="text-white" href="/seller_Registration_status">Seller registration status
                                    </a></li>
                            @endif

                        @if (Auth::user()->role_id == '2')
                            <li><a class="text-white" href="/seller_center">Seller center
                                </a></li>
                        @endif
                        <li><a class="text-white" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    @endguest
                    <li><a class="border-none" href="#"><span>

                                </span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bottom pt-40 pb-30 clearfix">
        <div class="header-bottom-wrapper pr-200 pl-200">
            <div class="logo-3">
                <a href="{{ route('home') }}">
                    <img src="/assets/img/logo/logo-3.png" alt="">
                </a>
            </div>
            <div class="categories-search-wrapper">

                <div class="categories-wrapper">
                    <form hidden action="{{ route('products.search') }}" method="GET">
                        <input name="query" placeholder="Search here..." type="text">
                        <button type="submit"><i class="pe-7s-search"></i> SEARCH</button>
                    </form>
                    <form action="{{ route('products.search') }}"  method="GET">
                                <input name="query" placeholder="I am looking for . . ." type="text">
                                <button>
                                    <i class="ti-search"></i>
                                </button>
                            </form>
                </div>
            </div>
            <div class="trace-cart-wrapper">
            @auth
                <div class="categories-cart same-style">
                    <div class="same-style-icon">
                        <a href="/user_orders"><i class="pe-7s-box1"></i></a>
                    </div>
                    <div class="same-style-text">
                        
                        <a href="/user_orders">My orders
                        </a>
                        <br>
                    </div>
                </div>
                @else
                @endauth

                <div class="categories-cart same-style">
                    <div class="same-style-icon">
                        <a href="{{ route('cart.index') }}"><img src="/assets/img/basket_icon.png" height="45"></a>
                    </div>
                    <div class="same-style-text">
                        <a href="{{ route('cart.index') }}">My Basket <br>

                            @auth
                                {{ Cart::session(auth()->id())->getContent()->count() }}
                            @else
                                0
                            @endauth

                            Item
                        </a>
                    </div>
                </div>


                <div class="categories-cart same-style">
                    <div class="same-style-icon">
                        <a href="/user_coins_top_up"><img src="/assets/img/coins_icon.jpg" height="45"></a>
                    </div>
                    <div class="same-style-text">
                        <a href="/user_coins_top_up">Agcoins <br>
                            @auth

                            {{ App\agcoins::getAgCoins() }}
                            @else
                                0
                            @endauth
                            Pesos
                        </a>
                        <br>
                    </div>
                </div>

                
              
                
            </div>
        </div>
    </div>

  
</header>


@if(session('message'))

    <div class="alert alert-success text-center" role="alert">
        <strong>{{ session('message') }}</strong>
    </div>
@endif

@if(session('error'))

    <div class="alert alert-danger text-center" role="alert">
        <strong>{{ session('error') }} </strong>
    </div>
@endif


@yield('content')


<footer class="footer-area">

    <div class="footer-middle text-white bg-success pt-35 pb-40" style="background-color: #50CB93;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="footer-services-wrapper mb-30">
                        <div class="footer-services-icon">
                            <i class="pe-7s-cash"></i>
                        </div>
                        <div class="footer-services-content">
                            <h3 class=" text-white">Cheap agricultural products</h3>
                            <p class=" text-white">Prices are as cheap as the agricultural products in villasis </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="footer-services-wrapper mb-30">
                        <div class="footer-services-icon">
                            <i class="pe-7s-check"></i>
                        </div>
                        <div class="footer-services-content">
                            <h3 class=" text-white">Safe transactions</h3>
                            <p class="text-white">Agrisell users/sellers requires a valid id to register</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="footer-bottom  black-bg pt-25 pb-30 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5">
                    <div class="footer-menu">
                        <nav>
                            <ul>

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-6 col-md-7">
                    <div class="copyright f-right mrg-5">
                        <p class="text-white">
                            Copyright ©
                            <a href="#">AgriSell</a> 2021 . All Right Reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- modal -->


<!-- all js here -->
<script src="/assets/js/vendor/jquery-1.12.0.min.js"></script>
<script src="/assets/js/popper.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/assets/js/isotope.pkgd.min.js"></script>
<script src="/assets/js/imagesloaded.pkgd.min.js"></script>
<script src="/assets/js/jquery.counterup.min.js"></script>
<script src="/assets/js/waypoints.min.js"></script>
<script src="/assets/js/ajax-mail.js"></script>
<script src="/assets/js/owl.carousel.min.js"></script>
<script src="/assets/js/plugins.js"></script>
<script src="/assets/js/main.js"></script>

@livewireScripts
</body>

</html>
