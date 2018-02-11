
<!DOCTYPE html>
<html lang="en">
<title>Sign in</title>
  <head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <?php 
      echo '<link rel="stylesheet" type="text/css" href="style.css"/>';
      echo '<link rel="stylesheet" type="text/css" href="bootstrap-social.css"/>';
      
    ?>

  </head>




  <body>
    <div class="login-container" align="center">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <h2 style="text-align: center">Sign In</h2>
          <div class="login-wall">  
          <img class="profile-img" src="image/semen_indonesia1.png" alt="logo" align="center">  
            <form name = "formx" class="form-signin" onsubmit="cek()" action="sinkron_exec.php" method="post">
              <input id="userip" name="userip" type="hidden"></input>
              <input type="text" name="username" class="form-control" placeholder="username" required autofocus>
              <input type="password" name="password" class="form-control" placeholder="password" required>
              <label class="checkbox pull-left">
                  <input type="checkbox" value="remember-me"> Selalu ingat saya
              </label>
              <input class="btn btn-lg btn-primary btn-success pull-right" type="submit" value="Sign In" style="width: 45%; float: right; margin-top:63px;"><br><br>
            </form>
            <form action="register/register.php">
              <input class="btn btn-lg btn-primary pull-right" type="submit" value="Sign Up" style="width: 40%; float: left; margin-left:20px;"><br><br>
            </form>
            <a href="password/forgot_password.php" class="need-help">Lupa password? </a><span class="clearfix"></span>
            
            

                      <?php
                       if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
                        
                        foreach($_SESSION['ERRMSG_ARR'] as $msg) {
                          echo $msg; 
                          }
                        
                        unset($_SESSION['ERRMSG_ARR']);
                        }
                      ?>
       <!-- alert message -->
        <!--<div id=alert></div>
      </div> 

    
      <a class="btn btn-block btn-social btn-linkedin" href="ldap/ldap_index.php" style="top:0.3cm;">Sign In dengan @SIG.CORP<span class="glyphicon glyphicon-user"></span></a>
      <a class="btn btn-block btn-social btn-google" href="<?php echo $authUrl;?>" style="top:0.3cm;">Sign In dengan Google<span class="fa fa-google"></span></a>


    </div>
  </div>
  
</div>-->





      <div class="footer">
        <h4>PT Semen Indonesia (Persero) Tbk </h4>
        <p> Gedung Utama Semen Indonesia (GUSI) <br>
            Jl. Veteran, Gresik 61122 <br>
            Jawa Timur, Indonesia <br>
            Phone: +62313981732 | Fax: +62313983209 | E-mail: info@semenindonesia.com
        </p>
      </div>
  </body>
</html>

 