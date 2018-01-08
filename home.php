    <?php
    	require_once('auth.php');
        require_once('connection.php');
    ?>
    
    <!--
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Home</title>
    <style type="text/css">
   
    .style1 {
    	font-size: 36px;
    	font-weight: bold;
    }
    
    </style>
    </head>
     -->
<!DOCTYPE html>
<html lang="en">
<title>Home</title>
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

    <body>
        <form action="welcome.php" method="get" name="welcome">
        <div class="container" align="center">
            <div class="row">
              <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="row">
                    <div class="account-wall" >
                       <table width="300" border="0" align="center" cellpadding="2" cellspacing="5">
                       
                       <?php 
                            echo '<b>Selamat Datang, </b>'.$_SESSION['SESS_USERNAME']. '<br>';  
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
                       <p align="center">This page is the home, you can put some stuff here......</p>
                       <td width="134"><p align="left"><a href="changepass.php">Ubah password</a></p></td>
                       <td width="134"><div><a class="btn btn-lg btn-primary btn-sm pull-right" type="submit" value="Sign In" style="width: 80%; float:right;" href="index.php">Sign Out</a></div></td>
                       </table>
                    </div>
                </div>
              </div>
            </div>
        </div>
        </form>
                
        

          <div class="footer">
            <h4>PT Semen Indonesia (Persero) Tbk </h4>
            <p> Gedung Utama Semen Indonesia (GUSI) <br>
                Jl. Veteran, Gresik 61122 <br>
                Jawa Timur, Indonesia <br>
                Phone: +62313981732 | Fax: +62313983209 | E-mail: info@semenindonesia.com
            </p>
          </div>
    </body>


    



  <!--   <body>
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