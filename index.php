<?php
      //Start session
      session_start();  
      //Unset the variables stored in session
      unset($_SESSION['SESS_ID']);
      unset($_SESSION['SESS_USERNAME']);
      unset($_SESSION['SESS_PASSWORD']);
    ?>

 <?php
                       if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
                        echo '<ul class="err">';
                        foreach($_SESSION['ERRMSG_ARR'] as $msg) {
                          echo '<li>',$msg,'</li>'; 
                          }
                        echo '</ul>';
                        unset($_SESSION['ERRMSG_ARR']);
                        }
                      ?>
<!DOCTYPE html>
<html lang="en">
<title>Sign in</title>
  <head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <?php 
      echo '<link rel="stylesheet" type="text/css" href="style.css"/>';
    ?>

  </head>
  <body class="img-fluid" alt="Responsive image">
    <div class="container" align="center">
      <div class="row">
          <div class="col-sm-6 col-md-4 col-md-offset-4">
    <!--<form name="loginform" action="login_exec.php" method="post">
    <table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
      <tr>
        <td colspan="2"> -->
        <!--FORM LOGIN-->
      
          <h2 class="display-4">Sign In</h2>
                  <div class="account-wall" >
                    <img class="profile-img" src="semen_indonesia1.png"
                          alt="logo">
                      <form class="form-signin" action="login_exec.php" method="post">
                      <input type="text" name="username" class="form-control" placeholder="username" required autofocus>
                      <input type="password" name="password" class="form-control" placeholder="password" required>
                      <label class="checkbox pull-left">
                          <input type="checkbox" value="remember-me">
                          Selalu ingat saya
                      </label>
                      <input class="btn btn-lg btn-primary pull-right" type="submit" value="Sign In" style="width: 40%; float: right;">
                      <br><br>
                      <a href="forgot_password.php" class="need-help">Lupa password? </a><span class="clearfix"></span>                 
                      </form>
                  </div>
                  <a href="register.php" class="text-center new-account">Buat akun baru </a>
              </div>

     <!--     <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Warning!</strong> Better check yourself, you're not looking too good.
          </div>  -->

      </div>
  </div>

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

      <!--<tr>
        <td width="116"><div align="right">Username</div></td>
        <td width="177"><input name="username" type="text" /></td>
      </tr>
      <tr>
        <td><div align="right">Password</div></td>
        <td><input name="password" type="password" /></td>
      </tr>
      <tr>
        <td><a href="forgot_password.php">Forgot password?</a></td>
        <td><input name="" type="submit" value="login" /></td>
      </tr>
    </table>
    </form>


     <form name="signinform" action="register.php" method="post"> -->
      <!--FORM SIGN IN-->
     <!-- <table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
      <tr>
        <td width="116"><div align="right"></div></td>
        <td width="177"><input name="" type="submit" value="signin" /></td>
      </tr>
    </table>
  </form> -->