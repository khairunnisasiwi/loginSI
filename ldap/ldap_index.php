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
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="assets/styles.css" rel="stylesheet">


    <?php 
      echo '<link rel="stylesheet" type="text/css" href="style.css"/>';
      echo '<link rel="stylesheet" type="text/css" href="bootstrap-social.css"/>';
    ?>


	<style>
		body {text-align: center;}
		form {margin: 0 auto; width: 500 px;}
		input {padding: 10px; font-size: 20;} 
	</style>
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

});
</script>

<body>
    <div class="ldap-container">
        <h1><label>SIG</label><small>  Sign In </small></h1>
        <div class="ldap-wall">
            <img src="semen_indonesia1.png" style="width:35%;height:35%;margin-bottom:40px;" alt="logo" align="center">
        	<form name="formx" class="form-signin" action = "ldap_login.php" onsubmit="cek()" method = "post">
        		<input id="userip" name="userip" type="hidden"></input>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="username" placeholder="your e-mail" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <span class="input-group-text input-group-lg" id="basic-addon2" style="border-radius:0; padding-top:10px;">@sig.corp</span>
                </div>
        		<input class="form-control form-control-lg" type = "password" name = "password" placeholder="password" required/> <br>
        		<input class="btn btn-lg btn-block btn-primary" type = "submit" name = "Sign In" value="Sign In"/> <br>
            </form>
        </div>
        <?php
            $_SESSION['msg'] = isset($_GET['msg']) ? $_GET['msg'] : "";
            $regmsg = $_SESSION['msg'];
            echo $regmsg; // ERROR MASSAGE DI SINI                     
        ?>
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

 