<?php
	session_start();
	include '../connection.php';
	//require_once('auth.php');

	function replace_none ($data){
		if ($data == '' || $data == '0'){
			return 'unknown';
		}
		else{
			return $data;
		}
	}

	$id = $_SESSION['SESS_ID'];

	$ip = $_POST['userip'];
    $host = gethostbyaddr($ip);

    //KONEKSI AD
	$ldap_username = $_POST["username"];
	$ldap_dn = "uid=".$ldap_username.",dc=example,dc=com";
	$ldap_password = $_POST["password"];

	$ldap_con = ldap_connect("ldap.forumsys.com"); //server link
	ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3); //set versi protokol

	$attrs = array("cn","mail","telephonenumber");

	if (@ldap_bind($ldap_con, $ldap_dn, $ldap_password)){
		//echo "Authenticated";
		$filter = "(uid=$ldap_username)";
		echo $filter;
		$result = ldap_search($ldap_con, "dc=example,dc=com", $filter, $attrs) or exit("Not found");
		$entries = ldap_get_entries($ldap_con, $result);
		array_shift($entries);

		$i = 0;
		//print "<pre>";
		foreach ($entries as $u) {
			if(isset($u["cn"][0])) $fullname = $u["cn"][0]; else $fullname = 'unknown';
			if(isset($u["mail"][0])) $email = $u["mail"][0]; else $email = 'unknown';
			if(isset($u["telephonenumber"][0])) $phone = $u["telephonenumber"][0]; else $phone = '0';
			$i++;
		}


		$sql_get = mysqli_query ($bd, "SELECT * FROM users WHERE ad_mapping = '$email'");
        $num_row = mysqli_num_rows ($sql_get);
        //fungsi script ini adalah untuk mengecek apa username sudah masuk ke db web
        if ($num_row ==0) {
        	$get_exp_date = mysqli_query($bd, "SELECT * from policy where profile_name = 'Other'");
        	$get_exp = mysqli_fetch_array ($get_exp_date);
        	$exp = $get_exp['expiry_pass'];

        	/*$filter = "(uid=$ldap_username)";
			$result = ldap_search($ldap_con, "dc=example,dc=com", $filter, $attr);
			$entries = ldap_get_entries($ldap_con, $result);
			array_shift($entries);

			$fullname = isset($entries["cn"][0]);
			$mail = isset($entries["mail"][0]);
			$phone = isset($entries["telephonenumber"][0]);
			
			if(isset($entries["cn"][0])) $fullname = $entries["cn"][0]; else $fullname = 'unknown';
			if(isset($entries["mail"][0])) $mail = $entries["mail"][0]; else $mail = 'unknown';
			if(isset($entries["telephonenumber"][0])) $phone = $entries["telephonenumber"][0]; else $phone = '0';*/
			$userss = mysqli_query($bd, "SELECT * from users where id = '$id'");
			$userarr = mysqli_fetch_array ($userss);
			$type = $userarr['tipe_login'];


          	$insert = mysqli_query ($bd,"UPDATE users set ad_mapping = '$email',tipe_login = '$type,AD' WHERE id = $id");

        	$sql_get = mysqli_query ($bd, "SELECT * FROM users WHERE ad_mapping = '$email'");
        	$get = mysqli_fetch_array($sql_get);
        	$id = $get['id'];
        	$ri = $get['role'];
        	$pi = $get['profile'];
        	//$username = $get['username'];
        	//$pass = $get['password'];

        	/*$getrole= mysqli_query($bd, "SELECT * FROM role where role_id = '$ri'");
        	$role = mysqli_fetch_array($getrole);
        	$rolename = $role['rolename'];

        	$prof = mysqli_query($bd, "SELECT * FROM profiles WHERE profile = $pi");
            $profs = mysqli_fetch_array($prof);
            $profile = $profs['profile_name'];*/

			//$insert1 = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$ldap_username','$rolename','$profile',NOW(),'1','$ldap_username','username','$ip','$host')");
			//$insert2 = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$ldap_username','$rolename','$profile',NOW(),'1','$fullname','fullname','$ip','$host')");
			//$insert3 = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$ldap_username','$rolename','$profile',NOW(),'1','$rolename','role','$ip','$host')");
			//$insert4 = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$ldap_username','$rolename','$profile',NOW(),'1','$profile','profile','$ip','$host')");
			//$insert5 = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$ldap_username','$rolename','$profile',NOW(),'1','$email','email','$ip','$host')");

        	//$valid_until = mysqli_query($bd, "SELECT date_password_expiry FROM users WHERE username = '$ldap_username'");
            //$valid = mysqli_fetch_array ($valid_until);

        	//echo "Pendaftaran akun baru berhasil <br>";
			//echo "Selamat Datang, " . $ldap_username. "<br>";
            //echo "Password anda berlaku hingga " .$valid['date_password_expiry'] . "<br>";
            //echo "Login <a href='../index.php'>disini</a>";
            $_SESSION['SESS_ID'] = $id;
	        $_SESSION['SESS_USERNAME'] = $get['username'];
	        $_SESSION['SESS_PASSWORD'] = $get['password'];
	        $_SESSION['SESS_ROLE'] = $ri;
	        $last_login = mysqli_query($bd, "UPDATE users set last_login = NOW() WHERE id= '$id'");
	        $_SESSION['IP'] = $ip;
			session_write_close();
	        header("location: ../home.php");
	        exit();
	
        }
        else{
        	$regmsg = "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='regsuccess'> Akun AD sudah terdaftar.";
        	session_write_close();
        	header("location: ad_sync.php?msg=$regmsg");
        	exit();
        }
        //$get_data = mysqli_query($bd, "SELECT * FROM users WHERE username = '$ldap_username'");
        $get = mysqli_fetch_array($sql_get);

        $_SESSION['SESS_ID'] = $get['id'];
        $_SESSION['SESS_USERNAME'] = $get['username'];
        $_SESSION['SESS_PASSWORD'] = $get['password'];
        $_SESSION['SESS_ROLE'] = $get['role'];
        $last_login = mysqli_query($bd, "UPDATE users set last_login = NOW() WHERE id= '$id'");
        $_SESSION['IP'] = $ip;
		session_write_close();
        header("location: ../home.php");
        exit();
	}
	else{
		$regmsg = "<div class='alert alert-warning alert-dismissible fade show' role='alert' id='regsuccess'> Username atau Password Salah.";
        session_write_close();
        header("location: ad_sync.php?msg=$regmsg");
        exit();
	}
?>