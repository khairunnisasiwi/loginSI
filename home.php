    <?php
      //require_once('auth.php');
      require_once('connection.php');
      require_once('auth.php');
      $_SESSION['gid'] = isset($_SESSION['gid']) ? $_SESSION['gid'] : "";
      $gid= $_SESSION['gid'];
       if ($gid == "0"){
        include "add_google.php";
                           
                   
    }
      
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
      echo '<link rel="stylesheet" type="text/css" href="style.css"/>';


    ?>

   

<div id='cssmenu'>
<ul>
  <li class='has-sub' style="float:left; margin-right:0.5cm;"><a href='#'><span class="caret fa fa-lg">&#xf021;</span></a>
    <ul>
    <?php 
    $id = $_SESSION['SESS_ID'];
    $get = mysqli_query($bd,"SELECT * FROM users WHERE id = '$id'");
    $getarr = mysqli_fetch_array($get);
    $ldap_map = $getarr['ldap_mapping'];
    $ad_map = $getarr['ad_mapping'];

    if ($ldap_map == ""){
      echo "<li><a href='ldap/ldap_sync.php'><span>Sinkronkan dengan LDAP</span></a</li>";
    }

    if($ad_map == ""){
      echo "<li><a href='ad/ad_sync.php'><span>Sinkronkan dengan AD</span></a></li>";
    }


    if ($gid == "0"){
                         
     echo "<li><a href=$authUrl><span>Sinkronkan dengan Google</span></a></li>";
                   
    }
                        
    ?>
      </ul>
    </li>

   <li class='has-sub' style="float:left; margin-right:0.5cm;"><a href='#'><span class="caret">Akun Saya</span></a>
      <ul>

<?php /*if (isset($_GET['lokal'])) {
 echo " <li><a href='password/changepass.php'><span>Ubah Password</span></a></li>";
    
}*/?>
        <li><a href='password/changepass.php'><span>Ubah Password</span></a></li>
         <li><a href='edituser/edituser.php'><span>Ubah Profil</span></a></li>
         <li><a href='index.php?logout=1'><span>Sign Out</span></a></li>

       
      </ul>
    </li>

    <?php
    $role = $_SESSION['SESS_ROLE'];
    

    $app = mysqli_query($bd, "SELECT * FROM users JOIN role ON users.role = role.role_id WHERE role_id = '$role'");
    $apparr = mysqli_fetch_array($app);
    $rolename= $apparr['rolename'];
  
    ?>

    <li class='has-sub' style="float:left; margin-right:0.5cm;"><a href='#'><span class="caret">Aplikasi</span></a>
      <ul>
        <?php
                include "connection.php";
                $role = mysqli_query($bd, "SELECT * from approle where $rolename ='1'");
                $no = 1; 
                                 
                  while ($row   = mysqli_fetch_array($role)){

                    ?>
                      <li><?php echo "<a href='".$row['app_link']."'><span>".$row['app_name']."</span></a></li>";?> </li> <?php
                      $no++;
                    }
                  ?>       
     
      </ul>
    </li>
      
      
    <?php
    
    $gid= $_SESSION['gid'];

   
    $id = $_SESSION['SESS_ID'];
    $role = $_SESSION['SESS_ROLE'];
    

    $app = mysqli_query($bd, "SELECT * FROM users JOIN role ON users.role = role.role_id WHERE role_id = '$role'");
    $apparr = mysqli_fetch_array($app);
    $rolename= $apparr['rolename'];
  
       $apps = mysqli_query($bd, "SELECT * FROM approle WHERE app_name='app1'");
       $apparrs = mysqli_fetch_array($app);

    
  ?>



   
   
   
</ul>

</div>

      
  </head>
  
    <body>

       <!--AUTO POPUP GANTI PASSWORD-->
    
    <?php
    $expdate = mysqli_query($bd, "SELECT * FROM users WHERE id = '$id'");
    $exp = mysqli_fetch_array($expdate);
    $expired = $exp['date_password_expiry'];
    $fullname = $exp['fullname'];

    $last_login = mysqli_query($bd, "UPDATE users set last_login = NOW() WHERE id= '$id'");
    $login = mysqli_query($bd, "SELECT last_login FROM users WHERE id = '$id'");                
    $log = mysqli_fetch_array($login);
    $now = $log['last_login'];
    $remainday = strtotime($expired) - strtotime($now);
    $remain = round($remainday/(60*60*24));
    $reminder = mysqli_query($bd, "SELECT reminder_name, day_remind FROM reminder WHERE day_remind = '$remain'");                            
    $remind = mysqli_fetch_assoc($reminder);
    $rem_name = $remind ['reminder_name'];
    $rem_day  = $remind ['day_remind'];

    if ($now >= $expired){

            $_SESSION['msg'] = isset($_GET['msg']) ? $_GET['msg'] : "";
            $msg = $_SESSION['msg'];

      echo 
      '<div id="overlay">
      <div id="changepwd" class="pwd-container">
        <div class="pwd-wall">
                    <h4 class="modal-title" align="center">Ubah Password Anda</h4><br>
                    <form action="password/changepassact.php?ganti=1" id="submit" method="post">
                      <div class="alert alert-danger"><label>Maaf, password Anda sudah kadaluarsa. Silahkan ubah password Anda.</label></div>
                      <div align="left">Password Lama: </div>
                      <input type="password" name="oldpass" id="oldpass" class="form-control" required autofocus><br>
                      <div align="left">Password Baru: </div>
                      <input type="password" name="newpass" id="newpass" class="form-control" required><br>
                      <div align="left">Konfirmasi Password Baru: </div>
                      <input type="password" name="confirm" id="confirm" class="form-control" required><br>
                      <div align="right"> 
                      <input type="submit" class="btn btn-primary btn-md" style="height:10%; width:20%; margin-top:0.3cm; margin-bottom:0.5cm;" value="Ubah"><br>
                      </div>
                    </form>
                    <div>'.$msg.'</div>
               </div>
             </div>

           </div>
           ';

         }
         ?>
          

     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
      <script type="text/javascript">

        $(document).ready(function(){
          $("#changepwd, #overlay").hide().fadeIn(1000);
          

        $("#submit").ajaxForm(function() { 
            window.location.replace("home.php");
        });
      
        });
        </script> 

      <!--PANEL UNTUK KONTEN-->
    <div class="container-fluid newhome-container" align="center">
      <div class="col-md-6" align="center">
        <div class="panel panel-default">
        <div class="panel-body">
          <div class="newhome-wall" align="center" >
            <img class="user-profpic" src="image/user.png" alt="logo" align="center"> 
            <?php 
                           

            echo '<h1>Selamat Datang, <b> '.$fullname. '</b></h1><br>'; 

            
            
                            
         
            if ($now < $expired){         
                                
                                if($remain == $rem_day){
                                   echo $rem_name. " password anda akan kadaluarsa! <br>";
                                }
                                else{
                                    echo "Password anda berlaku hingga <br>" .date('d M Y H:i:s', strtotime($expired)). "<br>"; 
                                }
                            }
                            else{
                                echo "Password anda sudah kadaluarsa! <br>";
                            }
                        ?>
                                       


        </div>
      </div>
      </div>
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