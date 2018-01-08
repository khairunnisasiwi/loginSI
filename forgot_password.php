<!DOCTYPE html>
<html lang="en">
<title>Lupa Password</title>
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

<body background="BG2.png">
    <form action="change.php" method="POST">
		<div class="container" align="center">
		    <div class="row">
          		<div class="col-sm-6 col-md-4 col-md-offset-4">
          	       	<div class="account-wall" >
          		        <table width="300" border="0" align="center" cellpadding="2" cellspacing="5">
		                    <p align="center" class="style4">Silahkan masukkan alamat e-mail Anda</p>
		                    <tr>
		                    	<input type="text" name="email"/>
		                    </tr>
		                    <tr>
								<input class="btn btn-lg btn-primary btn-sm" style="width: 40%;" type="submit" name="ForgotPassword" value=" Ubah Password " />
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