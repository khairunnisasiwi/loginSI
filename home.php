    <?php
    	require_once('auth.php');
        require_once('connection.php');
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Welcome</title>
        <style type="text/css">
            .style1 {
    	       font-size: 36px;
    	       font-weight: bold;
            }
        </style>
    </head>

    <body>
        <form action="welcome.php" method="post" name="welcome">
            <?php 
                echo '<b>Welcome:</b>'.$_SESSION['SESS_USERNAME']. '<br>';  
                $id = $_SESSION['SESS_ID'];
                $expdate = mysqli_query($bd, "SELECT date_password_expiry FROM users WHERE id = '$id'");
                $exp = mysqli_fetch_array($expdate);
                $expired = $exp['date_password_expiry'];
                $now = strtotime("now");

                if ($now > $expired){
                    echo "Your password is valid until " .$expired. "<br>";
                }
                else{
                    "Your password has been expired <br>";
                }
            ?>
        <a href="changepass.php">Change Password</a><br>
        <p align="center"><a href="index.php">logout</a></p><br>
        </form>
    </body>
    <!--<body>
    <p align="center" class="style1">Login successfully </p>
    <p align="center">This page is the home, you can put some stuff here......</p>
    <p align="center"><a href="index.php">logout</a></p>
    </body>



    <body>
    <p align="center" class="style1">Password expired </p>
    <form name="signinform" action="changepass.php" method="post">
      <table width="309" border="0" align="center" cellpadding="2" cellspacing="5">
      <tr>
        <td><div align="right"></div></td>
        <td><input name="" type="submit" value="Change Password" /></td>
      </tr>
      </table>
    </form>
    <p align="center"><a href="index.php">logout</a></p>
    </body> -->
    </html>