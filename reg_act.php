<?php include "connection.php"; 
    $username = addslashes(strip_tags ($_POST['username'])); 
    $fullname = addslashes(strip_tags ($_POST['fullname']));
    $role = addslashes(strip_tags ($_POST['role']));
    $employee_number = addslashes(strip_tags ($_POST['employee_number']));
    $email = addslashes(strip_tags ($_POST['email']));
    $phonenumber = addslashes(strip_tags ($_POST['phonenumber']));
    $address = addslashes(strip_tags ($_POST['address']));
    $password = addslashes(strip_tags ($_POST['password'])); 
    $confirm = addslashes(strip_tags ($_POST['confirm'])); 
     //script ini untuk mengecek apakah form sudah terisi semua
 if ($username&&$password&&$confirm) { //berfunsgi untuk mengecek form tidak boleh lebih dari 10 
    if (strlen($username) > 10)
    {
    echo "username tidak boleh lebih dari 10 karakter";
}
else {
    //password harus 6-25 karakter
    if (strlen($password) > 25 || strlen($confirm) < 6){
        echo "Password harus antara 6-25 karakter";
    }
    else {
    //untuk mengecek apakah form password dan form konfirmasi password sudah sama
        if ($password == $confirm){
            $sql_get = mysql_query ("SELECT * FROM signup WHERE username = '$username'");
            $num_row = mysql_num_rows($sql_get);
        //fungsi script ini adalah untuk mengecek ketersediaan username, jika tidak tersedia maka program akan berjalan
            if ($num_row ==0) {
                $password = md5($password);
                $confirm = md5($confirm);
                $sql_insert = mysql_query("INSERT INTO signup VALUES ('$username','$fullname','$role','$employee_number','$email','$phonenumber','$address','$password','$confirm')");
                echo "Pendaftaran berhasil. Login <a href='index.php'>disini</a>";
            }
            else {
                echo "Username sudah terdaftar";
            }
        }   else {
            echo "Password yang kamu masukan tidak sama!";
            }
        }
    }
} else {
echo "Tolong penuhi form pendaftaran!";
}
?>