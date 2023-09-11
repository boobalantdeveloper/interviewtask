<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  

  <title>Login</title>

  <link href="css/style.default.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
</head>

<body class="signin">


<section>
  
    <div class="signinpanel" style="margin-right: 172px !important">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="panel panel-danger" style="width: 65.5%; margin-bottom:10px">
                    <div class="panel-heading" style="color:white;"> {{ $error }} </div>
                </div>
            @endforeach
        @endif
         @if ($message = Session::get('message'))
            <div class="panel panel-success" style="width: 65.5%; margin-bottom:10px">
                <div class="panel-heading"  style="color:white;" > {{ $message }} </div>
            </div>
        @endif
        <div class="row">
            
            <div class="col-md-8">
                
                <form method="post" action="dologin">
                    @csrf

                    <h4 class="mt5 mb20 pull-right" style="color:white"><b>LOGIN</b></h4><br>
                    
                
                    <input type="text" class="form-control uname" name="username" value="{{old('username')}}" placeholder="Username" />
                    <input type="password" class="form-control pword" name="password" placeholder="Password" />
                    <button type="submit" class="btn btn-info btn-block">LOGIN</button>
                    <div class="signup-footer" style="font-weight:bold;color:white" >
            
        </div>
                </form>
            </div><!-- col-sm-5 -->
            
        </div><!-- row -->
        
        
        
    </div><!-- signin -->
  
</section>


<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/jquery.cookies.js"></script>

<script src="js/toggles.min.js"></script>
<script src="js/retina.min.js"></script>

<script src="js/custom.js"></script>
<script>
    jQuery(document).ready(function(){
        
        // Please do not use the code below
        // This is for demo purposes only
        var c = jQuery.cookie('change-skin');
        if (c && c == 'greyjoy') {
            jQuery('.btn-success').addClass('btn-orange').removeClass('btn-success');
        } else if(c && c == 'dodgerblue') {
            jQuery('.btn-success').addClass('btn-primary').removeClass('btn-success');
        } else if (c && c == 'katniss') {
            jQuery('.btn-success').addClass('btn-primary').removeClass('btn-success');
        }
    });
</script>

</body>
</html>
