<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
</head>
 
<body>
<form action="reg_act.php" method="post">
	<table width="500" border="0" align="center" cellpadding="2" cellspacing="5">
		<tr>
			<td width="131"><div>Username</div></td>
			<td width="177"><input name="username" type="text" required /></td>
		</tr>
		<tr>
			<td><div>Password</div></td>
        	<td><input name="password" type="password" required /></td>
        </tr>
        <tr>
        	<td><div>Confirm Password </div></td>
        	<td><input name="confirm" type="password" required /></td>
        </tr>
        <tr>
        	<td><div>Full Name </div></td>
        	<td><input name="fullname" type="text" required /></td>
        </tr>
        <tr>
        	<td><div>Role </div></td>
        	<td><input type="radio" name="role" <?php if (isset($role) && $role==1) echo "checked";?> value=1>Employee
        		<input type="radio" name="role" <?php if (isset($role) && $role==2) echo "checked";?> value=2>Customer
				<input type="radio" name="role" <?php if (isset($role) && $role==3) echo "checked";?> value=3>Supplier
			</td>
		</tr>
		<tr>
			<td><div>Employee Number </div></td>
			<td><input name="employee_number" type="text" /></td>
		</tr>
		<tr>
        	<td><div>Bagian </div></td>
        	<td><input type="radio" name="profile" <?php if (isset($profile) && $profile==1) echo "checked";?> value=1>Keuangan
        		<input type="radio" name="profile" <?php if (isset($profile) && $profile==2) echo "checked";?> value=2>Pemasaran
			</td>
		</tr>
		<tr>
			<td><div>E-mail </div></td>
			<td><input name="email" type="email" required /></td>
		</tr>
		<tr>
			<td><div>Phone Number </div></td>
			<td><input name="phonenumber" type="text" required /> </td>
		</tr>
		<tr>
			<td><div> Address </div></td>
			<td><input name="address" type="text" /> </td>
		</tr>
		<tr>
			<td><div align="right"></div></td>
			<td><input type="submit" value="Register"/> </td>
		</tr>
	</table>
</form>
</body>
</html>