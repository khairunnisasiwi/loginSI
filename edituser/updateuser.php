<?php
	include '../connection.php';
	require_once('../auth.php');
	$ip = $_SESSION ['IP'];
	$host = gethostbyaddr($ip);

	// menyimpan data kedalam variabel
	$username = $_POST['username'];
	$id = $_POST['id'];
	$fullname = $_POST['fullname']; 
	$role = $_POST['role'];
	$employeenumber = $_POST['employeenumber'];
	$profile = $_POST['profile'];
	$email = $_POST['email'];
	$phonenumber = $_POST['phonenumber'];
	$address = $_POST['address'];


	$oldusername = $_POST['oldusername'];
	$oldfullname = $_POST['oldfullname']; 
	$oldrole = $_POST['oldrole'];
	$oldemployeenumber = $_POST['oldemployeenumber'];
	$oldprofile = $_POST['oldprofile'];
	$oldemail = $_POST['oldemail'];
	$oldphonenumber = $_POST['oldphonenumber'];
	$oldaddress = $_POST['oldaddress'];

	$profileqr= mysqli_query($bd, "SELECT profile FROM profiles WHERE profile_name='$profile'");
	$profid = mysqli_fetch_array($profileqr);
	$pi = $profid['profile'];

	$roleqr= mysqli_query($bd, "SELECT role_id FROM role WHERE rolename='$role'");
	$roleid = mysqli_fetch_array($roleqr);
	$ri = $roleid['role_id'];

	//,email=$email,phone_number=$phonenumber,date_password_expiry=$expireddate
	 //$get_idprofile = 
	$update=mysqli_query($bd, "UPDATE users set fullname='$fullname',email='$email',phone_number='$phonenumber',address = '$address' where id= '$id'");

	// echo $ip;

	
	if ($oldfullname != $fullname){
		$insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,prev_value,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$oldusername','$profile','$role',NOW(),'2','$oldfullname','$fullname','Nama Lengkap','$ip','$host')");
	}

	if ($oldemail != $email){
		$insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,prev_value,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$oldusername','$profile','$role',NOW(),'2','$oldemail','$email','E-mail','$ip','$host')");
	}

	if ($oldphonenumber != $phonenumber){
	 $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,prev_value,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$oldusername','$profile','$role',NOW(),'2','$oldphonenumber','$phonenumber','Telepon','$ip','$host')");
	}

	if ($oldaddress != $address){
	 $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,prev_value,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$oldusername','$profile','$role',NOW(),'2','$oldaddress','$address','Alamat','$ip','$host')");
	}



	 mysqli_query($db, $update);


	// mengalihkan ke halaman index.php
	header("location:../home.php")
?>