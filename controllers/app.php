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
        include_once "perfil.php";

        // objetos
        $register = new Register();
        $login = new Login();
        $chat = new Chat();
        $contacts = new Contacts();
        $perfil = new Perfil();

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

        // get_contacts_by_input
        if($action == "get_contacts_by_input")
        {
            $value = $_POST["value"]??"empty";

            $res = $chat->get_contacts_by_input($oCon, $value);
            echo $res;
        }

        // add_relationship
        if($action == "add_relationship")
        {
            $id = $_POST["id"]??"POST en id vacio";
            $id_contact = $_POST["id_contact"]??"POST en id_contact vacio";
            $res = $chat->add_relationship($oCon, $id, $id_contact);

            $date = get_date();
            $messege = "Hola, te he agregado como contacto";
            $sql = "CALL sp_add_messege($id, $id_contact, '$messege', '$date')";
            command($oCon, $sql);
            $sql_pending = "CALL sp_set_pending($id, $id_contact, 1)";
            command($oCon, $sql_pending);

            echo $res;
        }

        // delete_relationship
        if($action == "delete_relationship")
        {
            $id = $_POST["id"]??"POST en id vacio";
            $id_contact = $_POST["id_contact"]??"POST en id_contact vacio";
            $res = $chat->delete_relationship($oCon, $id, $id_contact);
            echo $res;
        }

        // get_data_user
        if($action == "get_data_user")
        {
            $res = $perfil->get_data_user($oCon);
            echo $res;
        }

        // update_user
        if($action == "update_user")
        {
            $user = $_POST["user"];
            $password = $_POST["password"];
            $gender = $_POST["gender"];

            $res = $perfil->update_user($oCon, $user, $password, $gender);
            echo $res;
        }
    }

?>