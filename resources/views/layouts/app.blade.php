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
        };
        window.laravelEchoPort= '{{env('LARAVEL_ECHO_PORT')}}'
        window.active_user = @json(\Illuminate\Support\Facades\Auth::user());
    </script>

    <title>{{ config('app.name', 'Thanka Auction') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/frontpage-custom.css') }}" rel="stylesheet">

    <script src="{{ asset('js/auction-count-down.js') }}"></script>
    <script language="JavaScript" type="text/javascript" src="{{ asset('js/moment.min.js') }}"></script>
</head>

<body>
    <div id="app">
        @include('inc.navbar')

        @yield('content')

        <div id="notification">we will have notification here</div>
        <div class="card-header">Dashboard <button id="sayHi" class="float-right btn btn-sm btn-warning">Say Hi!</button></div>

        <footer class="footer">
            <div class="container">
                <div class="pull-left">
                    &copy; Zorig Auction 2019
                </div>
                <div class="pull-right">
                    Site by <a href="#">Zorig Auction</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/custom-select.js') }}"></script>
    <script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
    <script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        window.Echo.channel('live-bidding-channel')
            .listen('SendLiveBidding', (data) => {
                console.log('listing data here ', data);
                i++;
                $("#notification").append('<div class="alert alert-success">'+data.title+'</div>');
            });
    </script>


    <script>
        $("#cart").on("click", function() {
            if ($(".shopping-cart").hasClass("hide"))
                $(".shopping-cart").removeClass("hide");
            else
                $(".shopping-cart").fadeToggle("fast");
        });

        $("#user-logout-option").on("click", function() {
            if ($(".user-drop-down-option").hasClass("hide"))
                $(".user-drop-down-option").removeClass("hide");
            else
                $(".user-drop-down-option").fadeToggle("fast");
        });

        $(window).click(function(e) {
            if ($(e.target).closest('.user-drop-down-option').length == 0 && $(e.target).closest(
                    '#user-logout-option').length == 0) {
                $(".user-drop-down-option").hide();
            }
        });

        $(window).click(function(e) {
            if ($(e.target).closest('.shopping-cart').length == 0 && $(e.target).closest('#cart').length == 0) {
                $(".shopping-cart").hide();
            }
        });

        let originalPrice, discountPercentage, priceAfterDiscount;
    </script>
    @yield('scripts')
</body>

</html>