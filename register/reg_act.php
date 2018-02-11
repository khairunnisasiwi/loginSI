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
      echo '<link rel="stylesheet" type="text/css" href="style.css"/>';
    ?>
</head>

<body>
    <form action="reg_act.php" method="post">
    <div class="login-container" align="center" id="reg-container">
        <div class="row">
            <div class="login-wall" align="center">

           <?php include "../connection.php"; 
          // require_once "auth.php";
             session_start();
             //AMBIL ISI FORM
             $username = addslashes(strip_tags ($_POST['username']));
             $password = addslashes(strip_tags ($_POST['password'])); 
             $confirm = addslashes(strip_tags ($_POST['confirm'])); 
             $fullname = addslashes(strip_tags ($_POST['fullname'])); 
             $role = addslashes(strip_tags ($_POST['role']));
             $employee_number = addslashes(strip_tags ($_POST['employee_number']));
             $profile = addslashes(strip_tags ($_POST['profile']));
             $email = addslashes(strip_tags ($_POST['email']));
             $phonenumber = addslashes(strip_tags ($_POST['phonenumber']));
             $address = addslashes(strip_tags ($_POST['address']));
             $ip = $_POST['userip'];
             $host = gethostbyaddr($ip);
             if ($username&&$password&&$confirm&&$fullname&&$role||$employee_number&&$profile&&$email&&$phonenumber&&$address) 
             { 

                //CHECK PROFILE DIPILIH PUNYA POLICY ATAU TIDAK, JIKA TIDAK SET POLICY OTHER
                

                $prof_id= mysqli_query($bd, "SELECT * FROM profiles where profile_name = '$profile'");
                $role_id= mysqli_query($bd, "SELECT * FROM role where rolename = '$role'");

                $profid = mysqli_fetch_array($prof_id);
                $roleid = mysqli_fetch_array($role_id);
                

                $pi = $profid ['profile'];
                $ri = $roleid ['role_id'];

                $prof = mysqli_query($bd, "SELECT * FROM policy WHERE profile_name = '$profile'");
                $profs = mysqli_fetch_array($prof);
                $po = $profs ['profile_name'];


                $profilecheck = $profile;

                if ($profilecheck == $po){
                    $profilecheck = $profile;
                }
                else
                {
                    $profilecheck = "other";
                }


                //AMBIL DATA POLICY DARI DATABASE
                $max_length = mysqli_query($bd, "SELECT max_pass_length FROM policy where profile_name = '$profilecheck'");
                $min_length = mysqli_query($bd, "SELECT min_pass_length FROM policy where profile_name = '$profilecheck'");
                $min_upc = mysqli_query($bd, "SELECT min_uppercase FROM policy where profile_name = '$profilecheck'");
                $min_loc = mysqli_query($bd, "SELECT min_lowercase FROM policy where profile_name = '$profilecheck'");
                $min_num = mysqli_query($bd, "SELECT min_numeric FROM policy where profile_name = '$profilecheck'");
                $min_spc = mysqli_query($bd, "SELECT min_special_char FROM policy where profile_name = '$profilecheck'");
                $exp_pass = mysqli_query($bd, "SELECT expiry_pass FROM policy where profile_name = '$profilecheck'");

                
                


                $minlg = mysqli_fetch_array($min_length);
                $maxlg = mysqli_fetch_array($max_length);
                $minup = mysqli_fetch_array($min_upc);
                $minlo = mysqli_fetch_array($min_loc);
                $minnc = mysqli_fetch_array($min_num);
                $minsc = mysqli_fetch_array($min_spc);
                $expwd = mysqli_fetch_array($exp_pass);


                if (strlen($username) > 10){
                    $regmsg = "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='regsuccess'> Username tidak boleh lebih dari 10 karakter </div>";
                    session_write_close();
                    //header("location: register.php?msg=$regmsg");
                    header("location: register.php?msg=$regmsg&un=$username&fn=$fullname&r=$role&en=$employee_number&pro=$profile&pn=$phonenumber&add=$address&em=$email&pi=$pi&ri=role_id");
                    //header("location: register.php?msg=$msg");
                    exit ();
                }
                else {
                    //cek panjang password
                    if (strlen($password) > $maxlg['max_pass_length'] || strlen($confirm) < $minlg['min_pass_length']){
                        $regmsg = "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='regsuccess'> Password harus antara ".$minlg['min_pass_length']." hingga " .$maxlg['max_pass_length']. " karakter </div>";
                        session_write_close();
                        header("location: register.php?msg=$regmsg&un=$username&fn=$fullname&r=$role&en=$employee_number&pro=$profile&pn=$phonenumber&add=$address&em=$email&pi=$pi&ri=role_id");
                        exit ();
                    }
                    else {
                        //hitung jumlah karakter huruf besar, huruf kecil, angka, dan karakter khusus
                        $array=str_split($password);
                        $upcase=sizeof (array_filter($array,'ctype_upper'));
                        $locase=sizeof (array_filter($array,'ctype_lower'));
                        $nucase=sizeof (array_filter($array,'ctype_digit'));
                        $spcase=sizeof (array_filter($array,'ctype_punct'));

                        //tes masuk policy atau tidak
                        if ($upcase < $minup['min_uppercase']) {
                            $regmsg = "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='regsuccess'> Password harus memiliki minimal huruf besar: ". $minup['min_uppercase'];
                            session_write_close();
                            header("location: register.php?msg=$regmsg&un=$username&fn=$fullname&r=$role&en=$employee_number&pro=$profile&pn=$phonenumber&add=$address&em=$email&pi=$pi&ri=role_id");
                            exit ();                                       
                        }
                        else {
                            if ($locase < $minlo['min_lowercase']) {
                                $regmsg = "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='regsuccess'> Password harus memiliki minimal huruf kecil: ". $minlo['min_lowercase'];
                                session_write_close();
                                header("location: register.php?msg=$regmsg&un=$username&fn=$fullname&r=$role&en=$employee_number&pro=$profile&pn=$phonenumber&add=$address&em=$email&pi=$pi&ri=role_id");
                                exit ();
                            }
                            else {
                                if ($nucase < $minnc['min_numeric']){
                                    $regmsg = "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='regsuccess'>Password harus memiliki minimal angka: ". $minnc['min_numeric'];
                                    session_write_close();
                                    header("location: register.php?msg=$regmsg&un=$username&fn=$fullname&r=$role&en=$employee_number&pro=$profile&pn=$phonenumber&add=$address&em=$email&pi=$pi&ri=role_id");
                                    exit ();
                                }
                                else {
                                    if ($spcase < $minsc['min_special_char']){
                                        $regmsg = "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='regsuccess'> Password harus memiliki minimal karakter khusus: ". $minsc['min_special_char'];
                                        session_write_close();
                                        header("location: register.php?msg=$regmsg&un=$username&fn=$fullname&r=$role&en=$employee_number&pro=$profile&pn=$phonenumber&add=$address&em=$email&pi=$pi&ri=role_id");
                                        exit ();
                                    }
                        //untuk mengecek apakah form password dan form konfirmasi password sudah sama
                                    else{
                                        if ($password == $confirm){
                                            $sql_get = mysqli_query ($bd, "SELECT * FROM users WHERE username = '$username'");
                                            $num_row = mysqli_num_rows ($sql_get);
                            //fungsi script ini adalah untuk mengecek ketersediaan username, jika tidak tersedia maka program akan berjalan
                                            if ($num_row ==0) {
                                                $password = md5($password);
                                                $confirm = md5($confirm);
                                                $expire = $expwd['expiry_pass'];

                                                 $insert = mysqli_query ($bd,"INSERT INTO users (username,password,confirm,fullname,role,employee_number,profile,email,phone_number,address,date_created,date_password_created,date_password_expiry,latest_ip_addr) VALUES ('$username','$password','$confirm','$fullname','$ri','$employee_number','$pi','$email','$phonenumber','$address',NOW(),NOW(),NOW() + interval '$expire' day,'$ip')");

                                                 $sql_get = mysqli_query ($bd, "SELECT * FROM users WHERE username = '$username'");
                                                 $num_row = mysqli_fetch_array ($sql_get);
                                                 $id = $num_row['id'];
                                                 //$ip = $num_row['latest_ip_addr'];

                                                 $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$username','$role','$profile',NOW(),'1','$username','username','$ip','$host')");

                                                 $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$username','$role','$profile',NOW(),'1','$password','password','$ip','$host')");

                                                 $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$username','$role','$profile',NOW(),'1','$fullname','fullname','$ip','$host')");

                                                 $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$username','$role','$profile',NOW(),'1','$role','role','$ip','$host')");

                                                 $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$username','$role','$profile',NOW(),'1','$employee_number','employee number','$ip','$host')");

                                                 $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$username','$role','$profile',NOW(),'1','$profile','profile','$ip','$host')");
                                                 
                                                 $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$username','$role','$profile',NOW(),'1','$email','email','$ip','$host')");                                                         
                                            
                                                $valid_until = mysqli_query($bd, "SELECT date_password_expiry FROM users WHERE username = '$username'");
                                                $valid = mysqli_fetch_array ($valid_until);
                                               // $date_expiry = date_add($date, date_interval_create_from_date_string($expwd));
                                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert' id='regsuccess'><span class='fa fa-lg' style='margin-right:10px;'>&#xf058;   </span><label>  Pendaftaran berhasil <label></div><br>";
                                                
                                                echo "Selamat Datang, <label>" . $fullname. "</label><br>";
                                                echo "Password anda berlaku hingga " .date('d M Y H:i:s', strtotime($valid['date_password_expiry'])) . "<br>";
                                                echo "Login <a href='../index.php'>disini</a>";
                                            }
                                            else {
                                                $regmsg = "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='regsuccess' > Username sudah terdaftar ";
                                                session_write_close();
                                                header("location: register.php?msg=$regmsg");
                                                exit ();
                                                
                                            }
                                        }
                                        else {
                                            $regmsg = "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='regsuccess'>Password yang kamu masukan tidak sama! ";
                                            session_write_close();
                                            header("location: register.php?msg=$regmsg");
                                            exit ();
                                            
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
             }
             else {
                $regmsg = "<div class='alert alert-danger alert-dismissible fade show' role='alert' id='regsuccess'><span class='fa'>&#xf071; </span> Tolong penuhi form pendaftaran! </div>";
                session_write_close();
                header("location: register.php?msg=$regmsg");
                exit ();
                
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
  