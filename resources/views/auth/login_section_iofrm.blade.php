<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrisell login</title>

    <link rel="stylesheet" type="text/css" href="/iofrm_assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/iofrm_assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="/iofrm_assets/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="/iofrm_assets/css/iofrm-theme8.css">
</head>
<body>
    <div class="form-body" class="container-fluid">
        <div class="website-logo">
            <a href="index.html">
                <div class="logo">
                    <img class="logo-size" src="/iofrm_assets/images/logo-light.svg" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <h3>Agrisell login</h3>
                    <p>Access to the most streamlined version of e-commerce for farmers </p>
                    <img src="/iofrm_assets/images/graphic4.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <div class="website-logo-inside">
                            <!-- <a href="index.html">
                                <div class="logo">
                                    <img class="logo-size" src="/iofrm_assets/images/logo-light.svg" alt="">
                                </div>
                            </a> -->
                        </div>
                        <div class="page-links">
                            <a href="/login" class="active">Login</a><a href="/register">Register</a><a href="/home">Homepage</a>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <input class="form-control" type="text" name="email" placeholder="E-mail Address" required>
                            <input class="form-control" type="password" name="password" placeholder="Password" required>
                            <div class="form-button">
                                <button type="submit" class="ibtn">Login</button>
                            </div>
                            @if (Route::has('password.request'))
                                    <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="/iofrm_assets/js/jquery.min.js"></script>
<script type="text/javascript" src="/iofrm_assets/js/popper.min.js"></script>
<script type="text/javascript" src="/iofrm_assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/iofrm_assets/js/main.js"></script>
</body>
</html>