<?php
    error_reporting(E_ALL & ~E_NOTICE);
    require_once('dbcon.php');
    if(isset($_POST["create"]))
    {
        $error = 0;
        if (isset($_POST['username']) && !empty($_POST['username'])) {
            $username=mysqli_real_escape_string($conn,trim($_POST['username']));
        }else{
            $error = 1;
            $empty_username="Username Cannot be empty.";
            echo $empty_username.'<br>';
        }

        if(!$error) {
            $sql="select * from account_info where username='$username';";
            $res=mysqli_query($conn,$sql);
            if (mysqli_num_rows($res) > 0) {
            // output data of each row
            $row = mysqli_fetch_assoc($res);
            if ($username==$row['username'])
            {
                echo "Username already exists";
            }
            elseif($email==$row['email'])
            {
                echo "Email already exists";
            }
        }else { //here you need to add else condition
            echo "alright";
        }
        }
    }
    ?>