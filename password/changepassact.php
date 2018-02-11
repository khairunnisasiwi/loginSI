<!DOCTYPE html>
<html lang="en">
<title>Sign In</title>
<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <?php 
      echo '<link rel="stylesheet" type="text/css" href="style1.css"/>';
    ?>
</head>

<body>
    <form action="changepassact.php" method="post">
    <div class="login-container" align="center" id="reg-container">
        <div class="row">
            <div class="login-wall" align="center">

<?php
      require_once('../auth.php');
      require_once('../connection.php');


      
      
       $oldpass=md5($_POST['oldpass']);
       $newpass=$_POST['newpass'];
       $confirm=$_POST['confirm'];
       $id=$_SESSION['SESS_ID'];
       $ip=$_SESSION['IP'];
       $username = $_SESSION['SESS_USERNAME'];
       $host = gethostbyaddr($ip);

       $profidqr = mysqli_query($bd, "SELECT profile FROM users WHERE id = '$id'");
       $profidarr = mysqli_fetch_array($profidqr); 
       $profid = $profidarr['profile'];

       $roleqr = mysqli_query($bd, "SELECT role FROM users WHERE id = '$id'");
       $rolearr = mysqli_fetch_array($roleqr); 
       $roleid = $rolearr['role'];
       
       $rolqr = mysqli_query($bd, "SELECT * FROM role WHERE role_id = '$roleid'");
       $rolarr = mysqli_fetch_array($rolqr); 
       $role = $rolarr['rolename'];

       $profileqr = mysqli_query($bd, "SELECT profile_name FROM profiles WHERE profile = '$profid'");
       $profilearr = mysqli_fetch_array($profileqr); 
       $profile = $profilearr['profile_name'];

       $exp_pass = mysqli_query($bd, "SELECT expiry_pass FROM policy WHERE profile_name='$profile'");
       $expwd = mysqli_fetch_array($exp_pass);    

       $chg_pwd = mysqli_query($bd, "SELECT password FROM users where id = '$id'");
       $chg_pwd1 = mysqli_fetch_array($chg_pwd);
       $data_pwd = $chg_pwd1['password'];



                $max_length = mysqli_query($bd, "SELECT max_pass_length FROM policy where profile_name = '$profile'");
                $min_length = mysqli_query($bd, "SELECT min_pass_length FROM policy where profile_name = '$profile'");
                $min_upc = mysqli_query($bd, "SELECT min_uppercase FROM policy where profile_name = '$profile'");
                $min_loc = mysqli_query($bd, "SELECT min_lowercase FROM policy where profile_name = '$profile'");
                $min_num = mysqli_query($bd, "SELECT min_numeric FROM policy where profile_name = '$profile'");
                $min_spc = mysqli_query($bd, "SELECT min_special_char FROM policy where profile_name = '$profile'");
                $exp_pass = mysqli_query($bd, "SELECT expiry_pass FROM policy where profile_name = '$profile'");

                $minlg = mysqli_fetch_array($min_length);
                $maxlg = mysqli_fetch_array($max_length);
                $minup = mysqli_fetch_array($min_upc);
                $minlo = mysqli_fetch_array($min_loc);
                $minnc = mysqli_fetch_array($min_num);
                $minsc = mysqli_fetch_array($min_spc);
                $expwd = mysqli_fetch_array($exp_pass);

              

        //ATURAN PANJANG PASSWORD
                    if (strlen($newpass) > $maxlg['max_pass_length'] || strlen($confirm) < $minlg['min_pass_length']){
                        $msg = "Password harus antara ".$minlg['min_pass_length']." hingga " .$maxlg['max_pass_length']. " karakter";
                        header("location: changepass.php?msg=$msg");
                        session_write_close();
                          if (isset($_GET['ganti'])) {
                                                header("location: ../home.php?msg=$msg");
                                                  
                                              }
                                              else{
                                                header("location: changepass.php?msg=$msg");
                                                exit ();
                                              }
                       
                    }
                    else {
                        //ATURAN MINIMUM HURUF BESAR, KECIL, NUM, CHAR
                        $array=str_split($newpass);
                        $upcase=sizeof (array_filter($array,'ctype_upper'));
                        $locase=sizeof (array_filter($array,'ctype_lower'));
                        $nucase=sizeof (array_filter($array,'ctype_digit'));
                        $spcase=sizeof (array_filter($array,'ctype_punct'));

                        
                        if ($upcase < $minup['min_uppercase']) {
                            $msg = "Password harus memiliki minimal huruf besar: ". $minup['min_uppercase'];
                            header("location: changepass.php?msg=$msg");
                            session_write_close();
                              if (isset($_GET['ganti'])) {
                                                header("location: ../home.php?msg=$msg");
                                                  
                                              }
                                              else{
                                                header("location: changepass.php?msg=$msg");
                                                exit ();
                                              }
                        }
                        else {
                            if ($locase < $minlo['min_lowercase']) {
                                $msg = "Password harus memiliki minimal huruf kecil: ". $minlo['min_lowercase'];
                                header("location: changepass.php?msg=$msg");
                                session_write_close();
                                  if (isset($_GET['ganti'])) {
                                                header("location: ../home.php?msg=$msg");
                                                  
                                              }
                                              else{
                                                header("location: changepass.php?msg=$msg");
                                                exit ();
                                              }
                            }
                            else {
                                if ($nucase < $minnc['min_numeric']){
                                    $msg =  "Password harus memiliki minimal angka: ". $minnc['min_numeric'];
                                    header("location: changepass.php?msg=$msg");
                                    session_write_close();
                                      if (isset($_GET['ganti'])) {
                                                header("location: ../home.php?msg=$msg");
                                                  
                                              }
                                              else{
                                                header("location: changepass.php?msg=$msg");
                                                exit ();
                                              }
                                }
                                else {
                                    if ($spcase < $minsc['min_special_char']){
                                        $msg = "Password harus memiliki minimal karakter khusus: ". $minsc['min_special_char'];
                                        header("location: changepass.php?msg=$msg");
                                        session_write_close();
                                          if (isset($_GET['ganti'])) {
                                                header("location: ../home.php?msg=$msg");
                                                  
                                              }
                                              else{
                                                header("location: changepass.php?msg=$msg");
                                                exit ();
                                              }
                                    } 
                                    else
                                      if ($data_pwd==$oldpass)
                                      {
                                       if($newpass==$confirm)
                                       {
                                            $newpass = md5($newpass);
                                            $expire = $expwd['expiry_pass'];
                                            $update_pwd=mysqli_query($bd, "UPDATE users set password='$newpass' where id= '$id'");
                                            $update_pwd_date = mysqli_query($bd, "UPDATE users set date_password_created = NOW() where id= '$id'");
                                            $update_pwd_expiry = mysqli_query($bd, "UPDATE users set date_password_expiry = NOW() + interval '$expire' day where id= '$id'");
                                            $valid_until = mysqli_query($bd, "SELECT date_password_expiry FROM users WHERE id = '$id'");
                                            $valid = mysqli_fetch_array ($valid_until);
                                            $insert = mysqli_query ($bd,"INSERT INTO history (username,rolename,profile_name,user_id,role_id,profile_id,date_change,action,prev_value,current_value,changed_field,accessed_ip,hostname) VALUES ('$username','$role','$profile','$id','$profid','$roleid',NOW(),'2','$oldpass','$newpass','password','$ip','$host')");
                                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='regsuccess'><span class='fa fa-lg' style='margin-right:10px;'>&#xf058;   </span><label> Password berhasil diubah. </label></div><br>";
                                            echo "Password Anda berlaku sampai ".date('d M Y H:i:s', strtotime($valid['date_password_expiry'])). "<br>";
                                            echo "<a style='margin-top: 20px;' href='../home.php'>Kembali</a>";
                                             }
                                        else{
                                            $msg = "Password yang Anda masukkan tidak cocok. ";
                                            session_write_close();
                                            if (isset($_GET['ganti'])) {
                                                header("location: ../home.php?msg=$msg");
                                                  
                                              }
                                              else{
                                                header("location: changepass.php?msg=$msg");
                                                exit ();
                                              }
                                            }
                                          }

                                        else{
                                           $msg = "Password lama yang Anda masukkan salah.";
                                           session_write_close();
                                              if (isset($_GET['ganti'])) {
                                               header("location: ../home.php?msg=$msg");
                                                  
                                              }
                                              else{
                                              header("location: changepass.php?msg=$msg");
                                                exit ();
                                              }
                                         }
                                       }
                                     }
                                   }
                                 }
                                 ?>

</div>
</div>
</div>
</form>

</body>
<div class="footer">
          <h4>PT Semen Indonesia (Persero) Tbk </h4>
          <p> Gedung Utama Semen Indonesia (GUSI) <br>
              Jl. Veteran, Gresik 61122 <br>
              Jawa Timur, Indonesia <br>
              Phone: +62313981732 | Fax: +62313983209 | E-mail: info@semenindonesia.com
          </p>
       </div>
</html>