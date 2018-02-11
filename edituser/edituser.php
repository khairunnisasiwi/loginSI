 <?php
        require_once('../auth.php');
      require_once('../connection.php');
    ?>

<?php

    $id = $_SESSION['SESS_ID'];
    $user  = mysqli_query($bd, "SELECT * from users where id='$id'");
    $row   = mysqli_fetch_array($user);

    $profid = $row['profile'];
    $profile = mysqli_query($bd, "SELECT * from profiles where profile='$profid'");
    $profname = mysqli_fetch_array($profile);


    $roleids = $row['role'];
    $roleid = mysqli_query($bd, "SELECT * from role where role_id='$roleids'");
    $rid = mysqli_fetch_array($roleid);

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
   <li class='has-sub'><a href='#'><span class="caret">Akun Saya</span></a>
      <ul>
         <li><a href='../password/changepass.php'><span>Ubah Password</span></a></li>
         <li><a href='edituser.php'><span>Ubah Profil</span></a></li>
         <li><a href='../index.php'><span>Sign Out</span></a></li>
      </ul>
    <li>
      <a href="../home.php"><span>Home</span></a>
   </li>
   </li>
 
</ul>

</div>

      
</head>

<body>
<div class="container-fluid newhome-container" align="center">
    <div class="col-md-4" align="left">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="chnguser-wall">
                    <h3 align="center">Ubah Profil</h3><br>
                    <form class="chnguser" name="chnguser" method="post" action="updateuser.php" onSubmit="return valid()">
                        <input type="hidden" value="<?php echo $row['id'];?>" name="id">
                        <input type="hidden" value="<?php echo $row['role'];?>" name="roleid">
                        <input type="hidden" value="<?php echo $row['profile'];?>" name="profid">
                        <input type="hidden" value="<?php echo $row['username'];?>" name="oldusername">
                        <input type="hidden" value="<?php echo $row['fullname'];?>" name="oldfullname">
                        <input type="hidden" value="<?php echo $profname['profile_name'];?>" name="profile">
                        <input type="hidden" value="<?php echo $rid['rolename'];?>" name="role">
                        <input type="hidden" value="<?php echo $row['email'];?>" name="oldemail">
                        <input type="hidden" value="<?php echo $row['phone_number'];?>" name="oldphonenumber">
                        <input type="hidden" value="<?php echo $row['address'];?>" name="oldaddress">
                        <input type="hidden" value="<?php echo $row['employee_number'];?>" name="oldemployeenumber">
                        <table cellpadding="5" align="center">
                        <div class="form-group">
                            <tr>
                            <td width="170"><label for="formGroupExampleInput">Username:</label></td>
                            <td width="350"><input type="text" class="form-control" id="formGroupExampleInput" name="username" value="<?php echo $row['username'];?>" name="username" disabled/></td>
                            </tr>
                        </div>
                        <div class="form-group">
                            <tr>
                            <td><label for="formGroupExampleInput">Fullname:</label></td>
                            <td><input type="text" class="form-control" id="formGroupExampleInput" name="fullname" value="<?php echo $row['fullname'];?>" name="fullname" required /></td>
                            </tr>
                        </div>
                        <div class="form-group">
                            <tr>
                            <td><label for="formGroupExampleInput">Role:</label></td>
                            <td><input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $rid['rolename'];?>" disabled/></td>
                            </tr>
                        </div>
                        <div class="form-group">
                            <tr>
                            <td><label for="formGroupExampleInput">Employee Number:</label></td>
                            <td><input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $row['employee_number'];?>" disabled/></td></tr>
                        </div>
                        <div class="form-group">
                            <tr>
                            <td><label for="formGroupExampleInput">Bagian:</label></td>
                            <td><input type="text" class="form-control" id="formGroupExampleInput" value="<?php echo $profname['profile_name'];?>" disabled/></td></tr>
                        </div>
                        <div class="form-group">
                            <tr>
                            <td><label for="formGroupExampleInput">E-mail:</label></td>
                            <td><input type="text" class="form-control" id="formGroupExampleInput" name="email" value="<?php echo $row['email'];?>" required /></td></tr>
                        </div>
                        <div class="form-group">
                            <tr>
                            <td><label for="formGroupExampleInput">Phone Number:</label></td>
                            <td><input type="text" class="form-control" id="formGroupExampleInput" name="phonenumber" value="<?php echo $row['phone_number'];?>" required /></td></tr>
                        </div>
                        <div class="form-group">
                            <tr>
                            <td><label for="formGroupExampleInput">Address:</label></td>
                            <td><input type="text" class="form-control" id="formGroupExampleInput" name="address" value="<?php echo $row['address'];?>" required /></td></tr>
                        </div>
                        <div>
                            <tr><td></td>
                                <td><input class="btn btn-primary btn-md" type="submit" value="Simpan" style="margin-top:15px;float:right;" /></td></tr>
                        </div>
                    </table>
                    </form>                     
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

        <!-- <form name="chngpwd" action="" method="post" onSubmit="return valid();">
        <table align="center">
        <tr height="50">
        <td>Old Password :</td>
        <td><input type="password" name="opwd" id="opwd"></td>
        </tr>
        <tr height="50">
        <td>New Passowrd :</td>
        <td><input type="password" name="npwd" id="npwd"></td>
        </tr>
        <tr height="50">
        <td>Confirm Password :</td>
        <td><input type="password" name="cpwd" id="cpwd"></td>
        </tr>
        <tr>
        <td><a href="index.php">Back to login Page</a></td>
        <td><input type="submit" name="Submit" value="Change Passowrd" /></td>
        </tr>
         </table>
        </form> -->