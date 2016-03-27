<!DOCTYPE html>
<html lang="en">
    <head>
        <title>MyTracker</title>

        <link href="/bower/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="/bower/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="/bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

        <script src="/bower/jquery/dist/jquery.min.js" type="text/javascript"></script>
        <script src="/bower/moment/min/moment.min.js" type="text/javascript"></script>
        <script src="/bower/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Navbar Contents -->
            </nav>
        </div>

        @yield('content')
    </body>
</html>