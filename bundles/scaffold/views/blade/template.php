<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{{$title}} · Scaffold</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <!-- <link href="{{ asset('bundles/bootstrap/css/bootstrap.css') }}" rel="stylesheet"> -->
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <!-- Notify CSS -->
    <link href="{{ asset('bundles/bootstrap-notify/css/bootstrap-notify.css') }}" rel="stylesheet">
    
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="{{ asset('bundles/bootstrap/js/jquery-1.9.1.min.js') }}"></script> -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- <script src="{{ asset('bundles/bootstrap/js/bootstrap.js') }}"></script> -->
    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('bundles/bootstrap-notify/js/bootstrap-notify.js') }}"></script>

    <script type="text/javascript" src="{{ asset('bundles/bootstrap/lib/jquery/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bundles/bootstrap/lib/jquery/jquery.ui.datepicker-pt-BR.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('bundles/bootstrap/lib/jquery/jquery-ui.min.css') }}" media="screen" />

    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">

    <script type="text/javascript" src="{{ asset('js/mousetrap.min.js') }}"></script>

    <!-- Le fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/ico/favicon.png">
    <!-- Load Jquery DatePicker -->
    <script>
      $.datepicker.setDefaults( $.datepicker.regional[ "pt-BR" ] );
    </script>
    <style type="text/css">
    body {
      padding-top: 60px;
      padding-bottom: 40px;
    }
    .dr-fxwidth {
        width: 48px;
        white-space: nowrap;
    }
    td a:hover[class^="icon-"] {
        text-decoration:none;
        font-size:110%;
    }
    td a[class^="icon-"] {
        color:#333;
    }
    td a[class^="icon-"]:before, td a[class*="icon-"]:before {
        padding-right:2px;
    }
    /* Flatten das boostrap */
    .well,.navbar-inner,.popover,.btn,.tooltip,input,select,textarea,pre,.progress,.modal,.add-on,.alert,.table-bordered,.nav>.active>a,.dropdown-menu,.tooltip-inner,.badge,.label,.img-polaroid {
      -moz-box-shadow:none !important;
      -webkit-box-shadow:none !important;
      box-shadow:none !important;
      -webkit-border-radius:0px !important;
      -moz-border-radius:0px !important;
      border-radius:0px !important;
      border-collapse:collapse !important;
      background-image: none !important;
    }
    </style>
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          {{ HTML::link('/', 'Scaffold', 'class="brand"') }}
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="{{ URL::to('/'); }}"><i class="icon-home"></i> Home</a></li>
<?php foreach ($controllers as $key => $value): ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-tasks"></i> <?php echo ucwords(str_replace('_', ' ', basename($value, '.php'))); ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="{{ URL::to('<?php echo str_replace('_', DS, basename($value, '.php')); ?>'); }}"><i class="icon-tasks"></i> <?php echo ucwords(str_replace('_', ' ', basename($value, '.php'))); ?></a></li>
                  <li><a href="{{ URL::to('<?php echo str_replace('_', DS, basename($value, '.php')); ?>/adicionar'); }}"><i class=" icon-plus"></i> <?php echo ucwords(str_replace('_', ' ', basename($value, '.php'))); ?></a></li>
                </ul>
              </li>
<?php endforeach ?>
            </ul>
            <ul class="nav pull-right">
              <li id="fat-menu" class="dropdown">
                <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">Auth::user()->nome<b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                  <li><a href="#"><i class="icon-wrench"></i> Configurações</a></li>
                  <li><a href="#"><i class="icon-user"></i> Meu Perfil</a></li>
                  <li><a href="#"><i class="icon-envelope"></i> Alterar E-mail</a></li>
                  <li><a href="#"><i class="icon-edit"></i> Alterar Senha</a></li>
                  <li><a href="#"><i class="icon-trash"></i> Excluir Conta</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-tasks"></i> Aplicativos</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-hand-right"></i> Sair</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">


     <!-- Example row of columns -->
      <div class="row">
        <div class='notifications top-right'></div>
          @if (Session::has('message'))
            <script>
             $('.top-right').notify({
                message: { text: '{{ Session::get('message') }}' }
              }).show();
            </script>
          @endif

          @if($errors->has())
            @foreach($errors->all(':message') as $error)
              
            <script>
             $('.top-right').notify({
                type: 'danger',
                message: { text: '{{$error}}' }
              }).show();
            </script>
            @endforeach
          @endif

          {{$content}}

      </div>

      <hr>

      <footer>
        <p>&copy; Scaffold {{date('Y')}}</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>