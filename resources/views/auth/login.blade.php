<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Login</title>

  
  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/customLogin.css">
  <link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
  

</head>

<body>
  <div class="my-container">
    <div class="container ">
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-6 col-md-offset-3 my-formCont">
          <div class="my-form-top">
            <div class="my-form-top-left">
              <h1>Ingresar a <strong>Si.G.Re.T-GO</strong></h1>
            </div>
          </div>

          <div class="my-form-button">
            <form class="" role="form" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="text" placeholder="eMail" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" name="password" placeholder="Contraseña..." class="form-control" id="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>

              <div class="row">
                <div class="col-xs-12 col-md-5 col-xs-offset-0">
                  <button type="submit" class="btn btn-success btn-block"><b>INGRESAR</b></button>
                </div>
                <div class="col-xs-12 col-md-5 col-md-offset-0">
                  <a href="{{ route('register') }} " class="btn btn-info btn-block"><b>REGISTRARME</b></a>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
