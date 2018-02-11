
    <?php
        //Start session
        //session_start();
     
        //Include database connection details
        require_once('connection.php');
        include "auth.php";
        $id = $_SESSION['SESS_ID'];
        
         //$ip = $_POST['userip'];
     
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
        echo $username;
        
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
            header("location: sinkronisasi.php");
            exit();
        }
     
        //Create query
        
         $prof = mysqli_query($bd, "SELECT * FROM users WHERE id = $id");
         $profs = mysqli_fetch_array($prof);
         $gid = $profs ['google_id'];
         echo $gid;


        $qry="SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result=mysqli_query($bd, $qry);
        $insert = mysqli_query ($bd,"UPDATE users SET google_id ='$gid' WHERE username='$username'");
       // header("location: home.php");
        //$insert = mysqli_query ($bd,"UPDATE users SET latest_ip_addr ='$ip' WHERE username='$username'");
     
        //Check whether the query was successful or not
        /*if($result) {
            if(mysqli_num_rows($result) > 0) {
                //Login Successful
                session_regenerate_id();
                $member = mysqli_fetch_assoc($result);
                $_SESSION['SESS_ID'] = $member['id'];
                $_SESSION['SESS_USERNAME'] = $member['username'];
                $_SESSION['SESS_PASSWORD'] = $member['password'];
                $_SESSION['SESS_ROLE'] = $member['role'];
                $_SESSION['IP'] = $ip;
                session_write_close();
                header("location: home.php");
                exit();
            }else {
                //Login failed
                $errmsg_arr[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="regsuccess">Username dan password tidak ditemukan';
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
        }*/
    ?>

