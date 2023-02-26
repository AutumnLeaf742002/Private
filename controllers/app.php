<?php
    
    if(!empty($_POST))
    {
        
        include_once "connection.php";
        include_once "commands.php";
        session_start();
        $oCon = connect();

        $action = $_POST["action"];

        // Create user
        if($action == "create_user")
        {
            include_once "register.php";
            $register = new Register();
    
            $user = $_POST["user"];
            $password = $_POST["password"];
            $password_enc = encrypt($password);
            $gender = $_POST["gender"];
    
            $res = $register->create_user($user, $password_enc, $gender, $oCon);
    
            echo $res;
        }

        // Login user
        if($action == "login_user")
        {
            include_once "login.php";
            $login = new Login();
    
            $user = $_POST["user"];
            $password = $_POST["password"];
            $password_enc = encrypt($password);
    
            $res = $login->login_user($user, $password_enc, $oCon);

            if($res == true)
            {
                $_SESSION["user"] = $user;
            }
    
            echo $res;
        }

    }

?>