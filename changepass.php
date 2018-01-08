

<!DOCTYPE html>
<html lang="en">
<title>Sign in</title>
  <head>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <?php 
      echo '<link rel="stylesheet" type="text/css" href="style.css"/>';
    ?>

  </head>
  <body>
  	<form class="chngpwd" name="chngpwd" action="changepassact.php" method="post" onSubmit="return valid()">
	    <div class="pwdcontainer" align="center">
	    	<div class="row">
	        	<div class="col-sm-6 col-md-4 col-md-offset-4">
	            <h1 class="text-center login-title"><img src="semen_indonesia1.png" width="10%" height="10%">Ubah Password</h1>
	            	<div class="account-wall">
						<table>
					   	<tr>
                  		<input type="password" name="oldpass" id="oldpass" class="form-control" placeholder="masukkan password lama" required autofocus>
                  		</tr>
                  		<tr>
                  			<input type="password" name="newpass" id="newpass" class="form-control" placeholder="masukkan password baru" required>
						</tr>
						<tr>
							<input type="password" name="confirm" id="confirm" class="form-control" placeholder="konfirmasi password baru" required>
						</tr>
						<tr>
							<input type="submit" class="btn btn-primary" style="height:10%; width:15%; margin-top:0.3cm; margin-bottom:0.5cm;" value="Ubah">	
						</tr>
						</table>
					</div>
					<a href="home.php" class="text-center new-account" style="text-align: right;">Kembali ke Home</a>
			</div>
		</div>
	</div>
	</form>
</body>
</html>

		<!-- <form name="chngpwd" action="" method="post" onSubmit="return valid();">
		<table align="center">
		<tr height="50">
		<td>Old Password :</td>
		<td><input type="password" name="opwd" id="opwd"></td>
		</tr>
		<tr height="50">
		<td>New Passowrd :</td>
		<td><input type="password" name="npwd" id="npwd"></td>
		</tr>
		<tr height="50">
		<td>Confirm Password :</td>
		<td><input type="password" name="cpwd" id="cpwd"></td>
		</tr>
		<tr>
		<td><a href="index.php">Back to login Page</a></td>
		<td><input type="submit" name="Submit" value="Change Passowrd" /></td>
		</tr>
		 </table>
		</form> -->