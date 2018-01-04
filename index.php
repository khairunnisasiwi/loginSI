    <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

     <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="assets/css/loginformstyle.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/hover.zoom.js"></script>
    <script src="assets/js/hover.zoom.conf.js"></script>
    <?php
      include "connection.php";
    ?>
  </head>

  <body>
    <?php
    	//Start session
    	session_start();	
    	//Unset the variables stored in session
    	unset($_SESSION['SESS_MEMBER_ID']);
    	unset($_SESSION['SESS_FIRST_NAME']);
    	unset($_SESSION['SESS_LAST_NAME']);
    ?>
    

    <form name="loginform" action="login_exec.php" method="post">
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
      </tr>
      <tr>
        <td width="116"><div align="right">Username</div></td>
        <td width="177"><input name="username" type="text" /></td>
      </tr>
      <tr>
        <td><div align="right">Password</div></td>
        <td><input name="password" type="text" /></td>
      </tr>
      <tr>
        <td><div align="right"></div></td>
        <td><input name="" type="submit" value="login" /></td>
      </tr>
    </table>
    </form>

    <form name="signinform" action="register.php" method="post">
      <table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
      <tr>
        <td><div align="right"></div></td>
        <td><input name="" type="submit" value="sign in" /></td>
      </tr>
      </table>
    </form>
  </body>
</html>