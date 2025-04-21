<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SiGReT</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
        <link rel="stylesheet" href="{{asset ('css/customWelcome.css')}}">
        <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">

        <!-- Styles -->
        <style>

        </style>
    </head>
    <body>
        <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3">
                <div class="flex-center position-ref full-height">
                    <div class="content container">
                        <div class="title">
                            SiGReT
                        </div>
                        <div class="row opa">
                            <img src="/menus/img/caption.jpg" class="center-block img-responsive img-thumbnail" alt="Responsive image">
                        </div>
                        <hr>
                        <div class="row">
                            @if (Route::has('login'))
                                
                                @if (Auth::check())
                                    <div class="col-xs-12 col-sm-8 col-md-6 col-md-offset-3">
                                    <a href="{{ url('/home') }}" class="btn my-btn btn-success ">Home</a>
                                </div>
                                @else
                                    <div class="col-xs-12 col-sm-4 col-md-5 col-md-offset-1">
                                        <a href="{{ url('/login') }}" class="btn btn-success btn-block "><b>INICIAR SESION</b></a>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 col-md-5">
                                        <a href="{{ url('/register') }}" class="btn btn-info btn-block " ><b>REGISTRARME</b></a>
                                    </div>    
                                @endif
                            @endif
                        </div>     
                    </div>
                </div>      
            </div>   
        </div> 
        </div>
        

    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
