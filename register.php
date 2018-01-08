<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
</head>
 -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

   	<link rel="stylesheet" type="text/css" href="style.css">

  </head>
<body>
	<form action="reg_act.php" method="post">
	<div class="regcontainer" align="center">
	    <div class="row">
	        <div class="col-sm-6 col-md-4 col-md-offset-4">
	            <h1 class="text-center login-title"><img src="semen_indonesia1.png" width="10%" height="10%">Create New Account</h1>
	            <div class="account-wall">
					   <table width="500" border="0" align="center" cellpadding="2" cellspacing="5">
							<tr>
								<td width="131"><div>Username:</div></td>
								<td width="177"><input name="username" class="form-control" type="text" required /></td>
							</tr>
							<tr>
								<td><div>Password:</div></td>
					        	<td><input name="password" class="form-control" type="password" placeholder="min. 8 character" required /></td>
					        </tr>
					        <tr>
					        	<td><div>Confirm Password: </div></td>
					        	<td><input name="confirm" class="form-control" type="password" required /></td>
					        </tr>
					        <tr>
					        	<td><div>Full Name: </div></td>
					        	<td><input name="fullname" class="form-control" type="text" required /></td>
					        </tr>
					        <tr>
					        	<td><div>Role: </div></td>
					        	<td><input type="radio" name="role" <?php if (isset($role) && $role==1) echo "checked";?> value=1> Employee
        							<input type="radio" name="role" <?php if (isset($role) && $role==2) echo "checked";?> value=2> Customer
									<input type="radio" name="role" <?php if (isset($role) && $role==3) echo "checked";?> value=3> Supplier
								</td>
					       	</tr>
							<tr>
								<td><div>Employee Number: </div></td>
								<td><input name="employee number" class="form-control" type="text"/></td>
							</tr>
							<tr>
					        	<td><div>Bagian </div></td>
					        	<td><input type="radio" name="profile" style="display:none;" <?php echo "checked";?> value=0>
					        		<input type="radio" name="profile" <?php if (isset($profile) && $profile==1) echo "checked";?> value=1> Keuangan
					        		<input type="radio" name="profile" <?php if (isset($profile) && $profile==2) echo "checked";?> value=2> Pemasaran
								</td>
							</tr>
							<tr>
								<td><div>E-mail: </div></td>
								<td><input name="email" class="form-control" type="email" required /></td>
							</tr>
							<tr>
								<td><div>Phone Number: </div></td>
								<td><input name="phonenumber" class="form-control" type="text" required /> </td>
							</tr>
							<tr>
								<td><div> Address: </div></td>
								<td><input name="address" class="form-control" type="text" /> </td>
							</tr>
							<tr>
								<td><label class="checkbox pull-left"><input type="checkbox" value="remember-me" required> Semua data yang saya masukkan benar.</label></td>
								<td><input type="submit" class="btn btn-primary" style="float:right; height:20%;" value="Register"></td>
							</tr>
						</table>
	                </div>
	            </div>
	       </div>
	</div>
	
	</form>

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