    <?php
      //Start session
      session_start();  
      //Unset the variables stored in session
      unset($_SESSION['SESS_ID']);
      unset($_SESSION['SESS_USERNAME']);
      unset($_SESSION['SESS_PASSWORD']);
    ?>



    <form name="loginform" action="login_exec.php" method="post">
    <table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
      <tr>
        <td colspan="2">
        <!--FORM LOGIN-->
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
      </td>
      </tr>
      <tr>
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


     <form name="signinform" action="register1.php" method="post">
      <!--FORM SIGN IN-->
      <table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
      <tr>
        <td width="116"><div align="right"></div></td>
        <td width="177"><input name="" type="submit" value="signin" /></td>
      </tr>
    </table>
  </form>