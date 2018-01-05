   <?php
        //Start session
        session_start();    
        //Unset the variables stored in session
        unset($_SESSION['SESS_MEMBER_ID']);
        unset($_SESSION['SESS_FIRST_NAME']);
        unset($_SESSION['SESS_LAST_NAME']);
    ?>

    <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom styles for this template -->
    <link href="xampp/htdocs/loginSI/assets/css/loginformstyle.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/hover.zoom.js"></script>
    <script src="assets/js/hover.zoom.conf.js"></script>

    <?php
      include "connection.php";
    ?>
  </head>

  <body> 
    <form name="loginform" action="login_exec.php" method="post" style="top: 50% bottom: 50%">
    <table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
      <tr>
        <td colspan="2">
    		<!--the code bellow is used to display the message of the input validation-->
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

         <td>
          <div class="imgcontainer" align="center">
            <img src="img_avatar2.png" alt="Avatar" class="avatar">
         </div>

         <div class="container" align="left">
            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>
         </div>
         <br>
         <div class="container" align="left">
            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
         </div>

         <div class="container" align="center"> 
            <button type="submit">Login</button>
            <input type="checkbox" checked="checked"> Remember me
         </div>

         <div class="container" align="center">
            <button type="button" class="cancelbtn">Sign Up <a href="xampp/htdocs/loginSI/register.php"></a></button>
            <span class="psw">Forgot <a href="#">password?</a></span>
         </div>
        </td>
      </tr>
    </table>
  </form>
  </body>
</html>
