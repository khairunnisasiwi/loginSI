
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   	<link rel="stylesheet" type="text/css" href="style.css">
   	<?php 
      echo '<link rel="stylesheet" type="text/css" href="style.css"/>';
    ?>
  </head>

  <!--GET USER IP-->
   
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
	<form name = "formx"  onsubmit="cek()" action="reg_act.php" method="post">
	<input id="userip" name="userip" type="hidden"></input>
	<div class="reg-container" align="center" id="reg-container">
			<div class="row">
				<div class="reg-wall">
					<div>
					<h3>Buat Akun Baru</h3>
					<table width="500" border="0" align="center" cellpadding="2" cellspacing="5">
						<?php
					   		$_SESSION['un'] = isset($_GET['un']) ? $_GET['un'] : "";
					   		$_SESSION['fn'] = isset($_GET['fn']) ? $_GET['fn'] : "";
					   		$_SESSION['r'] = isset($_GET['r']) ? $_GET['r'] : "";
					   		$_SESSION['en'] = isset($_GET['en']) ? $_GET['en'] : "";
					   		$_SESSION['pro'] = isset($_GET['pro']) ? $_GET['pro'] : "Other";
					   		$_SESSION['pn'] = isset($_GET['pn']) ? $_GET['pn'] : "";
					   		$_SESSION['em'] = isset($_GET['em']) ? $_GET['em'] : "";
					   		$_SESSION['add'] = isset($_GET['add']) ? $_GET['add'] : "";
					   		$_SESSION['pi'] = isset($_GET['pi']) ? $_GET['pi'] : "";
					   		$_SESSION['ri'] = isset($_GET['ri']) ? $_GET['ri'] : "";
					   		$username=$_SESSION['un'];
					   		$fullname=$_SESSION['fn'];

					   		$role=$_SESSION['r'];
					   		$employeenumber=$_SESSION['en'];
					   		$profile=$_SESSION['pro'];
					   		$phonenumber=$_SESSION['pn'];
					   		$pi=$_SESSION['pi'];
					   		$ri=$_SESSION['ri'];

					   		$email=$_SESSION['em'];
					   		$address=$_SESSION['add'];
					   		
					   		?>

							<tr>
								<td width="131"><div>Username:</div></td>
								<td width="177"><input name="username" class="form-control" type="text" value="<?php echo $username;?>" required /></td>
							</tr>
							<tr>
								<td><div>Password:</div></td>
					        	<td><input name="password" class="form-control" type="password" required /></td>
					        </tr>
					        <tr>
					        	<td><div>Confirm Password: </div></td>
					        	<td><input name="confirm" class="form-control" type="password" required /></td>
					        </tr>
					        <tr>
					        	<td><div>Full Name: </div></td>
					        	<td><input name="fullname" class="form-control" type="text" value="<?php echo $fullname;?>" required /></td>
					        </tr>

					        <tr>
					        	<td><div>Role: </div></td>
					        	<td>
					        	<select class="form-control" id="exampleInputEmail1" name="role">
					        		<?php
					        		if($role==""){
					        			include '../connection.php';
										$sql  = mysqli_query($bd, "SELECT * from role ");
														                   
										
										while ($result = mysqli_fetch_array($sql)) {
																	
										echo "<option value='" . $result['rolename'] ."'>" . $result['rolename'] ."</option>";

					        		}}
					        		else {
					        			echo "<option value='" . $role ."'>" . $role ."</option>";

																		
										include '../connection.php';
										$sql  = mysqli_query($bd, "SELECT * from role where role_id != '$ri'");
														                   
										
										while ($result = mysqli_fetch_array($sql)) {
																	
										echo "<option value='" . $result['rolename'] ."'>" . $result['rolename'] ."</option>";
										
										}

						        		}
					        		?>

					      
				            </select>
				                </td>
        					</tr>

				        
							<tr>
								<td><div>Employee Number: </div></td>
								<td><input name="employee number" class="form-control" type="tel" value="<?php echo $employeenumber;?>"/></td>
							</tr>

							<tr>
					        	<td><div>Bagian: </div></td>
					        	<td>
					        	<select class="form-control" id="exampleInputEmail1" name="profile">
					        	<?php echo "<option value='" . $profile ."'>" . $profile ."</option>";?>
								<?php								
								include '../connection.php';
								$sql  = mysqli_query($bd, "SELECT * from profiles where profile_name != '$profile'");
												                   
								//echo "<select name='profile'>";
								while ($result = mysqli_fetch_array($sql)) {
															
								echo "<option value='" . $result['profile_name'] ."'>" . $result['profile_name'] ."</option>";
								}
								echo "</select>";
								                  
				                ?>
				                </select>
				                </td>
        					</tr>

							<tr>
								<td><div>E-mail: </div></td>
								<td><input name="email" class="form-control" type="email" value="<?php echo $email;?>" required /></td>
							</tr>
							<tr>
								<td><div>Phone Number: </div></td>
								<td><input name="phonenumber" class="form-control" type="text" value="<?php echo $phonenumber;?>" required /> </td>
							</tr>
							<tr>
								<td><div> Address: </div></td>
								<td><input name="address" class="form-control" value="<?php echo $address;?>" type="text" /> </td>
							</tr>
							
						</table>
		<!--			<label class="checkbox pull-left" style="padding-top:20px"><input type="checkbox" value="remember-me" required> Semua data yang saya masukkan benar.</label>  -->
						
						<input type="submit" class="btn btn-primary" style="float:right; margin-top:30px;" value="Register">

						
					</div>
				</div>
			</div>
			<?php
					   		
					   		$_SESSION['msg'] = isset($_GET['msg']) ? $_GET['msg'] : "";
					   		$regmsg = $_SESSION['msg'];
					   		echo $regmsg; // ERROR MASSAGE DI SINI
					   		
					   		?>
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