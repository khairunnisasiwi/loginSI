<?php
require_once ('libraries/Google/autoload.php');
include 'connection.php';
session_start();

$db_username = "root"; //Database Username
$db_password = ""; //Database Password
$host_name = "localhost"; //Mysql Hostname
$db_name = 'loginsi'; //Database Name

//API CLIENT ID

$client_id = '880862029258-9tf9et5jo57cr8app7o86ri0cb2lmk5c.apps.googleusercontent.com'; 
$client_secret = 'scAuIR47oLG-LugNqAEs_U9S';
$redirect_uri = 'http://localhost/loginsi/login_google.php';




if (isset($_GET['logout'])) {
  unset($_SESSION['access_token']);
  unset($_SESSION['IP']);
    
}

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

//Display user info or display login url as per the info we have.
echo '<div style="margin:20px">';
if (isset($authUrl)){ 
  $ip = $_POST['userip'];
  $_SESSION['IP']=$ip;
  echo $ip;
  header("location:$authUrl");


  
  //show login url
 /* echo '<div align="center">';
  echo '<h3>Login with Google -- Demo</h3>';
  echo '<div>Please click login button to connect to Google.</div>';
  echo '<a class="login" href="' . $authUrl . '"><img src="image/google-icon.png" /></a>';
  echo '</div>';*/
  
} else {
  
  $user = $service->userinfo->get(); //get user info 
  
  // connect to database
  $mysqli = new mysqli($host_name, $db_username, $db_password, $db_name);
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
  
  //check if user exist in database using COUNT
  $result = $mysqli->query("SELECT COUNT(google_id) as usercount FROM users WHERE google_id=$user->id");
  $user_count = $result->fetch_object()->usercount; //will return 0 if user doesn't exist
  
  //show user picture
  //echo '<img src="'.$user->picture.'" style="float: right;margin-top: 33px;" />';
  
  
  if($user_count) //if user already exist change greeting text to "Welcome Back"
   {
    $gid = $user->id;
    $ip=$_SESSION['IP'];
    $last_ip = mysqli_query($bd, "UPDATE users set latest_ip_addr = '$ip' WHERE google_id= '$gid'");  
    $last_login = mysqli_query($bd, "UPDATE users set last_login = NOW() WHERE google_id= '$gid'"); 
       
   
    $sql_get = mysqli_query ($bd, "SELECT * FROM users WHERE google_id = '$gid'");
    $get = mysqli_fetch_array($sql_get);
    
     $_SESSION['SESS_ID'] = $get['id'];
     $_SESSION['SESS_USERNAME'] = $get['username'];
     $_SESSION['SESS_ROLE'] = $get['role'];
      $_SESSION['gid'] = $gid;
      header ("location: home.php?gid=$gid&userip=userip");
    
       // echo 'Welcome back '.$user->name.'! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
    }
  else //else greeting text "Thanks for registering"
  { 
    $get_exp_date = mysqli_query($bd, "SELECT * from policy where profile_name = 'Other'");
    $get_exp = mysqli_fetch_array ($get_exp_date);
    $exp = $get_exp['expiry_pass'];
    $gname = $user->name;
    //echo 'Hi '.$user->name.', Thanks for Registering! [<a href="'.$redirect_uri.'?logout=1">Log Out</a>]';
    $statement = $mysqli->prepare("INSERT INTO users (username,tipe_login,role,profile,date_password_expiry,last_login,google_id, fullname, email, google_link, google_picture_link) VALUES ('google.$gname','Google','2','1',NOW() + interval '$exp' day,NOW(),?,?,?,?,?)");
    $statement->bind_param('issss', $user->id,  $user->name, $user->email, $user->link, $user->picture);
    $statement->execute();
    echo $mysqli->error;
    $gid = $user->id;
    $ip=$_SESSION['IP'];
    $host = gethostbyaddr($ip);
    //echo $ip;
    
    
    $email = $user->email;

    $sql_get = mysqli_query ($bd, "SELECT * FROM users WHERE google_id = '$gid'");
          $get = mysqli_fetch_array($sql_get);
          $ri = $get['role'];
          $pi = $get['profile'];
          $id = $get['id'];

          $getrole= mysqli_query($bd, "SELECT * FROM role where role_id = '$ri'");
          $role = mysqli_fetch_array($getrole);
          $rolename = $role['rolename'];

          $prof = mysqli_query($bd, "SELECT * FROM profiles WHERE profile = $pi");
          $profs = mysqli_fetch_array($prof);
          $profile = $profs['profile_name'];

      $insert1 = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','google.$gname','$rolename','$profile',NOW(),'1','$gname','Username','$ip','$host')");
      $insert2 = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','google.$gname','$rolename','$profile',NOW(),'1','$gname','Fullname','$ip','$host')");
      $insert3 = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','google.$gname','$rolename','$profile',NOW(),'1','$rolename','Role','$ip','$host')");
      $insert4 = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','google.$gname','$rolename','$profile',NOW(),'1','$profile','Profile','$ip','$host')");
      $insert5 = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','google.$gname','$rolename','$profile',NOW(),'1','$email','E-mail','$ip','$host')");
      $insert6 = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','google.$gname','$rolename','$profile',NOW(),'1','Google','Tipe Login','$ip','$host')");
      $insert6 = mysqli_query ($bd,"INSERT INTO history (user_id,role_id,profile_id,username,rolename,profile_name,date_change,action,current_value,changed_field,accessed_ip,hostname) VALUES ('$id','$ri','$pi','google.$gname','$rolename','$profile',NOW(),'1','$gid','Google id','$ip','$host')");

    $last_login = mysqli_query($bd, "UPDATE users set last_login = NOW() WHERE google_id= '$gid'");    
    $sql_get = mysqli_query ($bd, "SELECT * FROM users WHERE google_id = '$gid'");
    $get = mysqli_fetch_array($sql_get);
   session_start();
     $_SESSION['SESS_ID'] = $get['id'];
     $_SESSION['SESS_USERNAME'] = $get['username'];
     $_SESSION['SESS_ROLE'] = $get['role'];
      $_SESSION['gid'] = $gid;
     


   header ("location: home.php?gid=$gid&userip=$ip");
  }
  
  //print user details
 // echo '<pre>';
 // print_r($user);
 // echo '</pre>';
}
echo '</div>';
?>