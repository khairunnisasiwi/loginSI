 <?php
      require_once('../auth.php');
      require_once('../connection.php');
    ?>
    
    
<!DOCTYPE html>
<html lang="en">
<title>Home</title>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script.js"></script>

    <?php 
      echo '<link rel="stylesheet" type="text/css" href="style1.css"/>';
    ?>

    <?php
                        //OTORITAS USER
                         $id = $_SESSION['SESS_ID'];
                         $role = $_SESSION['SESS_ROLE'];
                         $app = mysqli_query($bd, "SELECT * FROM users JOIN role ON users.role = role.role_id WHERE role_id = '$role'");
                         $apparr = mysqli_fetch_array($app);
                         //$app1 = $apparr['app1'];
                         //$app2 = $apparr['app2'];
                         //$app3 = $apparr['app3'];

                       
                        ?>

<div id='cssmenu'>
<ul>
  <li class='has-sub' style="float:left; margin-right:0.5cm;"><a href='#'><span class="caret fa fa-lg">&#xf021;</span></a>
    <ul>
    <?php 
    $id = $_SESSION['SESS_ID'];
    $gid= $_SESSION['gid'];
    $get = mysqli_query($bd,"SELECT * FROM users WHERE id = '$id'");
    $getarr = mysqli_fetch_array($get);
    $ldap_map = $getarr['ldap_mapping'];
    $ad_map = $getarr['ad_mapping'];

    if ($ldap_map == ""){
      echo "<li><a href='../ldap/ldap_sync.php'><span>Sinkronkan dengan LDAP</span></a</li>";
    }

    if($ad_map == ""){
      echo "<li><a href='../ad/ad_sync.php'><span>Sinkronkan dengan AD</span></a></li>";
    }


    if ($gid == "0"){
                         
     echo "<li><a href=$authUrl><span>Sinkronkan dengan Google</span></a></li>";
                   
    }
                        
    ?>
      </ul>
    </li>
   <li class='has-sub'><a href='#'><span class="caret">Akun Saya</span></a>
      <ul>
         <li><a href='changepass.php'><span>Ubah Password</span></a></li>
         <li><a href='../edituser/edituser.php'><span>Ubah Profil</span></a></li>
         <li><a href='../index.php'><span>Sign Out</span></a></li>
      </ul>
   </li>
   <li>
      <a href="../home.php"><span>Home</span></a>
   </li>
  
</ul>

</div>

      
  </head>
  <body>
    <form class="chngpwd" name="chngpwd" action="changepassact.php" method="post" onSubmit="return valid()">
      <div class="change-container" align="center" id="change-container">
      <div class="row">
        <div class="change-wall">
          <div>
          <h3>Ubah Password</h3><br>
            <table width="500" border="0" align="center" cellpadding="2" cellspacing="5">
              <tr width="250">
                <div align="left">Password Lama: </div>
                <input type="password" name="oldpass" id="oldpass" class="form-control" required autofocus><br>
              </tr>
              <tr>
                <div align="left">Password Baru: </div>
                <input type="password" name="newpass" id="newpass" class="form-control" required><br>
              </tr>
              <tr>
                <div align="left">Konfirmasi Password Baru: </div>
                <input type="password" name="confirm" id="confirm" class="form-control" required><br>
              </tr>
              <tr>
                <input type="submit" class="btn btn-primary btn-md" style="height:10%; width:20%; margin-top:0.3cm; margin-bottom:0.5cm;" value="Ubah"> 
              </tr>
            </table>
            
          </div>
          <?php 
            $_SESSION['msg'] = isset($_GET['msg']) ? $_GET['msg'] : "";
            $msg = $_SESSION['msg'];
            
            echo $msg;?>
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
</html>

    