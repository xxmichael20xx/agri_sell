<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Agrisell</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body onload="print(); close();">
    <div class="container-fluid">
        @yield('content')
    </div>
</body>
</html>

<script>
    window.onload = () => {
        window.print()
        setTimeout(() => {
            window.close()
        } )
    }
</script>