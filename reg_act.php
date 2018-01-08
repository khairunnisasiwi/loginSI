<!DOCTYPE html>
<html lang="en">
<title>Sign In</title>
  <head>
    
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <?php 
      echo '<link rel="stylesheet" type="text/css" href="style.css"/>';
    ?>

  </head>

<body>
    <div class="container" align="center">
      <div class="row">
          <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall" align="center">  -->
            <?php include "connection.php"; 
             $username = addslashes(strip_tags ($_POST['username']));
             $password = addslashes(strip_tags ($_POST['password'])); 
             $confirm = addslashes(strip_tags ($_POST['confirm'])); 
             $fullname = addslashes(strip_tags ($_POST['fullname'])); 
             $role = addslashes(strip_tags ($_POST['role']));
             $employee_number = addslashes(strip_tags ($_POST['employee_number']));
             $profile = addslashes(strip_tags ($_POST['profile']));
             $email = addslashes(strip_tags ($_POST['email']));
             $phonenumber = addslashes(strip_tags ($_POST['phonenumber']));
             $address = addslashes(strip_tags ($_POST['address']));//script ini untuk mengecek apakah form sudah terisi semua 
             if ($username&&$password&&$confirm&&$fullname&&$role||$employee_number&&$profile&&$email&&$phonenumber&&$address) { //berfunsgi untuk mengecek form tidak boleh lebih dari 10 
                //atur password policy
                $max_length = mysqli_query($bd, "SELECT max_pass_length FROM profile where profile = '$profile'");
                $min_length = mysqli_query($bd, "SELECT min_pass_length FROM profile where profile = '$profile'");
                $min_upc = mysqli_query($bd, "SELECT min_uppercase FROM profile where profile = '$profile'");
                $min_loc = mysqli_query($bd, "SELECT min_lowercase FROM profile where profile = '$profile'");
                $min_num = mysqli_query($bd, "SELECT min_numeric FROM profile where profile = '$profile'");
                $min_spc = mysqli_query($bd, "SELECT min_special_char FROM profile where profile = '$profile'");
                $exp_pass = mysqli_query($bd, "SELECT expiry_pass FROM profile where profile = '$profile'");

                $minlg = mysqli_fetch_array($min_length);
                $maxlg = mysqli_fetch_array($max_length);
                $minup = mysqli_fetch_array($min_upc);
                $minlo = mysqli_fetch_array($min_loc);
                $minnc = mysqli_fetch_array($min_num);
                $minsc = mysqli_fetch_array($min_spc);
                $expwd = mysqli_fetch_array($exp_pass);

                if (strlen($username) > 10){
                    echo "username tidak boleh lebih dari 10 karakter";
                }
                else {
                    //cek panjang password
                    if (strlen($password) > $maxlg['max_pass_length'] || strlen($confirm) < $minlg['min_pass_length']){
                        echo "Password harus antara ".$minlg['min_pass_length']." hingga " .$maxlg['max_pass_length']. " karakter";
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
                            echo "Password harus memiliki minimal huruf besar: ". $minup['min_uppercase'];
                            echo "<br>";
                        }
                        else {
                            if ($locase < $minlo['min_lowercase']) {
                                echo "Password harus memiliki minimal huruf kecil: ". $minlo['min_lowercase'];
                                echo "<br>";
                            }
                            else {
                                if ($nucase < $minnc['min_numeric']){
                                    echo "Password harus memiliki minimal angka: ". $minnc['min_lowercase'];
                                    echo "<br>";
                                }
                                else {
                                    if ($spcase < $minsc['min_special_char']){
                                        echo "Password harus memiliki minimal karakter khusus: ". $minsc['min_special_char'];
                                        echo "<br>";
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
                                                $sql_insert = mysqli_query($bd, "INSERT INTO users VALUES ('','$username','$password','$confirm','$fullname','$role','$employee_number','$profile','$email','$phonenumber','$address', NOW(), NOW(), NOW() + interval '$expire' day)");

                                                $valid_until = mysqli_query($bd, "SELECT date_password_expiry FROM users WHERE username = '$username'");
                                                $valid = mysqli_fetch_array ($valid_until);
                                               // $date_expiry = date_add($date, date_interval_create_from_date_string($expwd));
                                                echo "Pendaftaran berhasil <br>";
                                                echo "Selamat Datang, " . $fullname. "<br>";
                                                echo "Your password is valid until " .$valid['date_password_expiry'] . "<br>";
                                                echo "Login <a href='index.php'>disini</a>";
                                            }
                                            else {
                                                echo "Username sudah terdaftar";
                                            }
                                        }
                                        else {
                                            echo "Password yang kamu masukan tidak sama!";
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
             }
             else {
                echo "Tolong penuhi form pendaftaran!";
             }
            ?>
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