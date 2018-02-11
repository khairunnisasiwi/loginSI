<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

    <?php
        //Start session
        session_start();
     
        //Include database connection details
        require_once('connection.php');
         $ip = $_POST['userip'];
     
        //Array to store validation errors
        $errmsg_arr = array();
     
        //Validation error flag
        $errflag = false;
     
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            echo "str: ".$str;
            $str = @trim($str);
            if(get_magic_quotes_gpc()) {
                $str = stripslashes($str);
            }
            return mysqli_real_escape_string($str);
        }
     
        //Sanitize the POST values
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        //Input Validations
        if($username == '') {
            $errmsg_arr[] = 'Username missing';
            $errflag = true;
        }
        if($password == '') {
            $errmsg_arr[] = 'Password missing';
            $errflag = true;
        }
     
        //If there are input validations, redirect back to the login form
        if($errflag) {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            session_write_close();
            header("location: index.php");
            exit();
        }
     
        //Create query
        $qry="SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result=mysqli_query($bd, $qry);
        $insert = mysqli_query ($bd,"UPDATE users SET latest_ip_addr ='$ip' WHERE username='$username'");

     
        //Check whether the query was successful or not
        if($result) {
            if(mysqli_num_rows($result) > 0) {
                //Login Successful
                session_regenerate_id();
                $member = mysqli_fetch_assoc($result);
                $_SESSION['SESS_ID'] = $member['id'];
                $_SESSION['SESS_USERNAME'] = $member['username'];
                $_SESSION['SESS_PASSWORD'] = $member['password'];
                $_SESSION['SESS_ROLE'] = $member['role'];
                $_SESSION['gid'] = $member['google_id'];
                $_SESSION['IP'] = $ip;
                session_write_close();
                header("location: home.php");
                exit();
            }else {
                //Login failed
                $errmsg_arr[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="regsuccess"><span class="fa">&#xf071; </span><small> Username dan password tidak ditemukan </small></div>';
                $errflag = true;
                if($errflag) {
                    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                    session_write_close();
                    header("location: index.php");
                    exit();

                
                }
            }
        }else {
            die("Query failed");
        }
    ?>

