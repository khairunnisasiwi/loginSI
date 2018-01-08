<?php
      require_once('auth.php');
      require_once('connection.php');
      
      
       $oldpass=md5($_POST['oldpass']);
       $newpass=$_POST['newpass'];
       $confirm=$_POST['confirm'];
       $id=$_SESSION['SESS_ID'];

       $exp_pass = mysqli_query($bd, "SELECT expiry_pass FROM profile JOIN users ON users.profile = profile.profile");
       $expwd = mysqli_fetch_array($exp_pass);    

       $chg_pwd = mysqli_query($bd, "SELECT password FROM users where id = '$id'");
       $chg_pwd1=mysqli_fetch_array($chg_pwd);
       $data_pwd=$chg_pwd1['password'];

       if($data_pwd==$oldpass){

        if($newpass==$confirm){
          $newpass = md5($newpass);
          $expire = $expwd['expiry_pass'];
          $update_pwd=mysqli_query($bd, "UPDATE users set password='$newpass' where id= '$id'");
          $update_pwd_date = mysqli_query($bd, "UPDATE users set date_password_created = NOW() where id= '$id'");
          $update_pwd_expiry = mysqli_query($bd, "UPDATE users set date_password_expiry = NOW() + interval '$expire' day where id= '$id'");
          $valid_until = mysqli_query($bd, "SELECT date_password_expiry FROM users WHERE id = '$id'");
          $valid = mysqli_fetch_array ($valid_until);

          echo "Update Sucessfully !!! <br>";
          echo "Your new password is valid until ".$valid['date_password_expiry']. "<br>";
        }
        else{
          echo "Your new and Retype Password is not match !!!";
        }
      }
      else
        {
          echo "Your old password is wrong !!!";
        }
      

    ?>