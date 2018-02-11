 <?php
     //Start session
  session_start();  
   //Unset the variables stored in session
  unset($_SESSION['SESS_ID']);
  unset($_SESSION['SESS_USERNAME']);
  unset($_SESSION['SESS_PASSWORD']);
  unset($_SESSION['SESS_ROLE']);
  unset($_SESSION['IP']);
  unset($_SESSION['access_token']);
 ?>

<!DOCTYPE html>
<html lang="en">
<title>Sign in</title>
  <head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <?php 
      echo '<link rel="stylesheet" type="text/css" href="style.css"/>';
      echo '<link rel="stylesheet" type="text/css" href="bootstrap-social.css"/>';
    ?>

  </head>

  <script type="text/javascript">
function getUserIP(onNewIP) { //  onNewIp - your listener function for new IPs
    //compatibility for firefox and chrome
    var myPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
    var pc = new myPeerConnection({
        iceServers: []
    }),
    noop = function() {},
    localIPs = {},
    ipRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g,
    key;

    function iterateIP(ip) {
        if (!localIPs[ip]) onNewIP(ip);
        localIPs[ip] = true;
    }

     //create a bogus data channel
    pc.createDataChannel("");

    // create offer and set local description
    pc.createOffer(function(sdp) {
        sdp.sdp.split('\n').forEach(function(line) {
            if (line.indexOf('candidate') < 0) return;
            line.match(ipRegex).forEach(iterateIP);
        });
        
        pc.setLocalDescription(sdp, noop, noop);
    }, noop); 

    //listen for candidate events
    pc.onicecandidate = function(ice) {
        if (!ice || !ice.candidate || !ice.candidate.candidate || !ice.candidate.candidate.match(ipRegex)) return;
        ice.candidate.candidate.match(ipRegex).forEach(iterateIP);
    };
}

// Usage

getUserIP(function(ip){
   
    document.formx.userip.value = ip;
    document.formix.userip.value = ip;

});
 </script>




 <!--LOGIN DENGAN GOOGLE+ -->
<?php
//include "login_google.php";
//$ip=$_POST['userip'];
//echo $ip;

?>



  <body>
    <div class="login-container" align="center">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <h2 style="text-align: center">Sign In</h2>
          <div class="login-wall">  
          <img class="profile-img" src="image/semen_indonesia1.png" alt="logo" align="center">  
            <form name = "formix" class="form-signin" onsubmit="cek()" action="login_exec.php" method="post">
              <input id="userip" name="userip" type="hidden"></input>
              <input type="text" name="username" class="form-control" placeholder="username" required autofocus>
              <input type="password" name="password" class="form-control" placeholder="password" required>
              <label class="checkbox pull-left">
                  <input type="checkbox" value="remember-me"> Selalu ingat saya
              </label>
              <input class="btn btn-lg btn-primary btn-success pull-right" type="submit" value="Sign In" style="width: 45%; float: right; margin-top:63px;"><br><br>
            </form>
            <form action="register/register.php">
              <input class="btn btn-lg btn-primary pull-right" type="submit" value="Sign Up" style="width: 40%; float: left; margin-left:20px;"><br><br>
            </form>
          
            
            <!--ALERT MESSAGE-->

                      <?php
                       if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
                        
                        foreach($_SESSION['ERRMSG_ARR'] as $msg) {
                          echo $msg; 
                          }
                        
                        unset($_SESSION['ERRMSG_ARR']);
                        }
                      ?>
       

<div id=alert></div>
      </div>  
      <p align="center" style="color:#8a8b8c;"><small>-ATAU SIGN IN DENGAN AKUN-</small></p>
      <table>
      <td><form name ="formx"  onsubmit="cek()" action="login_google.php" method ="POST">
        <input type="submit" class="fa btn btn-block btn-google" value="&#xf1a0; Google" style="height:1cm;width:3cm;"></a>
        <input id="userip" name="userip" type="hidden"></input>
      </form></td>
      <td><form action="ldap/ldap_index.php">
        <input type="submit" class="btn btn-block btn-linkedin" value="@SIG.CORP" style="top:1cm;width:3cm; margin: 0 5px 0 5px;"></a>
      </form></td>
      <td><form action="ad/ad_index.php">
        <input type="submit" class="btn btn-block btn-linkedin" value="@SMIG.CORP" style="top:1cm;width:3cm;"></a>
      </form></td>
    </table>
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

 