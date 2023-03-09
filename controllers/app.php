<?php
    
    if(!empty($_POST))
    {
        
        include_once "connection.php";
        include_once "commands.php";
        session_start();
        $oCon = connect();
        $action = $_POST["action"];

        //includes para los controladores php
        include_once "register.php";
        include_once "login.php";
        include_once "chat.php";
        include_once "contacts.php";

        // objetos
        $register = new Register();
        $login = new Login();
        $chat = new Chat();
        $contacts = new Contacts();

        // Determinantes

        // Create user
        if($action == "create_user")
        {
    
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
            $user = $_POST["user"];
            $password = $_POST["password"];
            $password_enc = encrypt($password);
            $res = $login->login_user($user, $password_enc, $oCon);
            echo $res;
        }

        // cerrar sesion
        if($action == "cerrar_sesion")
        {
            $res = $chat->cerrar_sesion();
            echo $res;
        }

        // get_contacts
        if($action == "get_contacts")
        {    
            $res = $contacts->get_contacts($oCon);
            echo $res;
        }

        // set_profile
        if($action == "set_profile")
        {
            $res = $contacts->set_profile($oCon);
            echo $res;
        }

        // set_chat
        if($action == "set_chat")
        {
            $id = $_POST["id"];
            $res = $chat->set_chat($oCon, $id);
            echo $res;
        }

        // get_messeges
        if($action == "get_messeges")
        {
            $res = $chat->get_messeges($oCon);
            echo $res;
        }

        // add_messege
        if($action == "add_messege")
        {
            $messege = $_POST["messege"]??"POST en messege vacio";
            $date = get_date();

            $res = $chat->add_messege($oCon, $messege, $date);
            echo $res;
        }
    }

?>