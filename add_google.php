<?php
require_once ('libraries/Google/autoload.php');
include 'connection.php';

$db_username = "root"; //Database Username
$db_password = ""; //Database Password
$host_name = "localhost"; //Mysql Hostname
$db_name = 'loginsi'; //Database Name

//API CLIENT ID

$client_id = '880862029258-9tf9et5jo57cr8app7o86ri0cb2lmk5c.apps.googleusercontent.com'; 
$client_secret = 'scAuIR47oLG-LugNqAEs_U9S';
$redirect_uri = 'http://localhost/loginsi/home.php';

//if (isset($_GET['logout'])) {
 // unset($_SESSION['access_token']);
//}

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

$service = new Google_Service_Oauth2($client);


if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  exit;
}

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}



if (isset($authUrl)){ 

  
} else {
  
  $user = $service->userinfo->get(); //get user info 
  
  // connect to database
  $mysqli = new mysqli($host_name, $db_username, $db_password, $db_name);
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
  
  //check if user exist in database using COUNT
  $result = $mysqli->query("SELECT COUNT(google_id) as usercount FROM users WHERE google_id=$user->id");
  $user_count = $result->fetch_object()->usercount;
  $gid = $user->id;

   //will return 0 if user doesn't exist
  
  //show user picture
  //echo '<img src="'.$user->picture.'" style="float: right;margin-top: 33px;" />';
  
  
  if($user_count) //if user already exist change greeting text to "Welcome Back"
   {
    $gid = $user->id;
    $gmail = $user->email;
   include "auth.php";
   $id = $_SESSION['SESS_ID'];
   $ip=$_SESSION['IP'];
   $host = gethostbyaddr($ip);

    $users = mysqli_query($bd,"SELECT * from users where id =$id");
    $userarr = mysqli_fetch_array($users);
     $tipe = $userarr['tipe_login'];
       
    $ri = $userarr['role'];
    $pi = $userarr['profile'];
    $username = $userarr['username'];

    $profiles = mysqli_query($bd,"SELECT * from profiles where profile =$pi");
    $profilearr = mysqli_fetch_array($profiles);
    $profile = $profilearr['profile_name'];

    $roles = mysqli_query($bd,"SELECT * from role where role_id =$ri");
    $rolearr = mysqli_fetch_array($roles);
    $role = $rolearr['rolename'];
    

    $beffusers = mysqli_query($bd,"SELECT * from users where google_id =$gid");
    $beffuserarr = mysqli_fetch_array($beffusers);
    $beffid = $beffuserarr['id'];
    $type = $beffuserarr['tipe_login'];

    if($type=="Google"){

        $query= "DELETE from users where google_id='$gid' AND tipe_login='Google'";
        mysqli_query($bd, $query);
        $busername = $beffuserarr['username'];
        $bri = $beffuserarr['role'];
        $bpi = $beffuserarr['profile'];
        $bfullname = $beffuserarr['fullname'];
        $bemail = $beffuserarr['email'];

        $bprofiles = mysqli_query($bd,"SELECT * from profiles where profile =$bpi");
        $bprofilearr = mysqli_fetch_array($bprofiles);
        $bprofile = $bprofilearr['profile_name'];

        $broles = mysqli_query($bd,"SELECT * from role where role_id =$bri");
        $brolearr = mysqli_fetch_array($broles);
        $brole = $brolearr['rolename'];

        $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$beffid','$bri','$bpi','$busername','$brole','$bprofile',NOW(),'3','$busername','Username','$ip','$host')");
        $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$beffid','$bri','$bpi','$busername','$brole','$bprofile',NOW(),'3','$bfullname','Fullname','$ip','$host')");          
        $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$beffid','$bri','$bpi','$busername','$brole','$bprofile',NOW(),'3','$bprofile','Profile','$ip','$host')");
        $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$beffid','$bri','$bpi','$busername','$brole','$bprofile',NOW(),'3','$brole','Role','$ip','$host')");
        $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$beffid','$bri','$bpi','$busername','$brole','$bprofile',NOW(),'3','$gmail','E-mail','$ip','$host')");
        $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$beffid','$bri','$bpi','$busername','$brole','$bprofile',NOW(),'3','$gid','Google id','$ip','$host')");
          

          
    }
    else{

      $setgid = mysqli_query($bd, "UPDATE users SET google_id='0',email='N/A' WHERE id='$beffid'");
    }

  //  $query= "DELETE from users where google_id='$gid' AND tipe_login='Google'";
  //  mysqli_query($bd, $query);
    
    $update=mysqli_query($bd, "UPDATE users set email='$gmail',google_id='$gid',tipe_login= '$tipe,Google' where id= '$id'");
    $_SESSION['gid']= $gid;



    $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$username','$role','$profile',NOW(),'2','$gmail','E-mail','$ip','$host')");
    $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$username','$role','$profile',NOW(),'2','$gid','Google id','$ip','$host')");
    $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$username','$role','$profile',NOW(),'2','$tipe,Google','Tipe Login','$ip','$host')");

   

    header ("location: home.php");
    
    /*$gid = $user->id;
    $last_login = mysqli_query($bd, "UPDATE users set last_login = NOW() WHERE google_id= '$gid'");    
    header ("location: home.php?gid=$gid&userip=userip");
    $sql_get = mysqli_query ($bd, "SELECT * FROM users WHERE google_id = '$gid'");
    $get = mysqli_fetch_array($sql_get);
    session_start();
     $_SESSION['SESS_ID'] = $get['id'];
     $_SESSION['SESS_USERNAME'] = $get['username'];
     $_SESSION['SESS_ROLE'] = $get['role'];*/
    
       // echo 'Welcome back '.$user->name.'! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
    }
  else //else greeting text "Thanks for registering"
  { 
    $ip=$_SESSION['IP'];
   $host = gethostbyaddr($ip);
    $gid = $user->id;
   include "auth.php";
    $id = $_SESSION['SESS_ID'];
    $users = mysqli_query($bd,"SELECT * from users where id =$id");
    $userarr = mysqli_fetch_array($users);
    
    
    $ri = $userarr['role'];
    $pi = $userarr['profile'];
    $username = $userarr['username'];

    $profiles = mysqli_query($bd,"SELECT * from profiles where profile =$pi");
    $profilearr = mysqli_fetch_array($profiles);
    $profile = $profilearr['profile_name'];

    $roles = mysqli_query($bd,"SELECT * from role where role_id =$ri");
    $rolearr = mysqli_fetch_array($roles);
    $role = $rolearr['rolename'];
    /*$get_exp_date = mysqli_query($bd, "SELECT * from policy where profile_name = 'Other'");
    $get_exp = mysqli_fetch_array ($get_exp_date);
    $exp = $get_exp['expiry_pass'];*/
    $gmail = $user->email;
    

   $update=mysqli_query($bd, "UPDATE users set email='$gmail',google_id='$gid'where id= '$id'");
   // echo "2";
  $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$username','$role','$profile',NOW(),'2','$gmail','E-mail','$ip','$host')");
    $insert = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','$username','$role','$profile',NOW(),'2','$gid','Google id','$ip','$host')");

    $_SESSION['gid']= $gid;
    header ("location: home.php?gid=$gid");
  }
  
  
}

?>