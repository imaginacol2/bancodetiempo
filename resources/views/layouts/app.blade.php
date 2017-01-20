<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/assets/icon.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tento</title>

    <!-- Styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="/css/rangeslider.css" rel="stylesheet">
    <link href="/bower_components/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Expletus+Sans|Roboto" rel="stylesheet">
    <!-- Scripts -->
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/bower_components/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>
    <script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.es.js"></script>
    <script src="/js/rangeslider.min.js"></script>
    <script src="/js/app.js"></script>

</head>
<body>
    <div id="app">
        <div id="coins">
            @if (!Auth::guest())
                <img src="/assets/coins.png" /> {{$usercoins}}
            @endif
        </div>
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    @if (!Auth::guest())
                        <button type="button" class="navbar-toggle collapsed profileright" data-toggle="collapse" data-target="#app-navbar-collapse">
                            @if($hasImage)
                                <img class="img-circle" src="/assets/profiles/{{$userid}}.jpg" />
                            @else
                                <img class="img-circle" src="/assets/user.png" />
                            @endif

                        </button>
                    @endif
                    <!-- Branding Image -->
					<div class="logo">
						<a href="{{ url('/') }}">
							<img src="/assets/logo.png" />
						</a>
					</div>
                </div>

                @if (!Auth::guest())
                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                            <li class="dropdown">
                                <a id="createactivity">
                                    Crear una actividad
                                </a>
                                <!--
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Mi Perfil
                                </a>
                                -->
                                <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar Sesión
                                </a>


                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>

                        </ul>
                    </div>
                @endif
            </div>
        </nav>

        @yield('content')
    </div>
    <div id="loadingcontent">
    </div>


    <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    @if (count($errors) > 0)

        <div id="errors" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Error</h4>
                        <div class="subtitle">Algo ha ocurrido</div>
                    </div>
                    <div class="modal-body">
                        <div class="errormessages">
                            @foreach ($errors->all() as $error)
                                <div class="errors">{!! $error !!}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <script>
            $( document ).ready(function() {
                $('#errors').modal();
            });
        </script>
    @endif



</body>
</html>
