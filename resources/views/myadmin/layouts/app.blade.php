<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        window.Laravel = {
            csrfToken: '{{ csrf_token()}}'
        }
    </script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>

    <title>{{ config('app.name', 'Thanka Auction') }}</title>

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div id="app">
                @include('myadmin.inc.navbar')
                <!-- page content -->
                <div class="right_col clearfix" role="main">

                    @include('myadmin.inc.messages')

                    @yield('content')

                </div>

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Bid N Buy by <a href="#">Bid N Buy</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>
    </div>

    <script language="JavaScript" type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/bootstrap-progressbar.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/custom.min.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/slug-widget.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/bootstrap-datetimepicker.js') }}">
    </script>
    <script language="JavaScript" type="text/javascript" src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        //admin users edit plate
        function showEditDelete(id, name) {

            $('#' + id).hover(function() {
                // alert("'."+name+"'");
                $('#' + name).show();
            }, function() {

                $('#' + name).hide();
            });

        }
    </script>
</body>

</html>