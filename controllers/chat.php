<?php

    class Chat
    {
        public function cerrar_sesion()
        {
            try 
            {
                session_destroy(); 

                return true;
            } catch(Exception $e) 
            {
                return $e;
            }
        }

        public function set_chat($oCon, $id)
        {
            $_SESSION["actual_contact"] = $id;
            $sql = "CALL sp_get_contact_chat($id)";
            $res = select($oCon, $sql);
            $html = "";

            foreach($res as $item)
            {
                if($item["Gender"] == 2)
                {
                    $html.= '
                    <div class="c-img">
                        <img src="../img/mujer.webp" alt="Private">
                    </div>
                    <h1>
                        '.$item["User"].'
                    </h1>
                    ';
                }
                else if($item["Gender"] == 1)
                {
                    $html.= '
                    <div class="c-img">
                        <img src="../img/hombre.jpg" alt="Private">
                    </div>
                    <h1>
                        '.$item["User"].'
                    </h1>
                    ';
                }
            }

            $id_user = $_SESSION["id"];
            $sql_pending = "CALL sp_set_pending($id, $id_user, 0)";
            command($oCon, $sql_pending);

            return $html;
        }

        public function get_messeges($oCon)
        {
            if(!empty($_SESSION["actual_contact"]))
            {
                $actual_contact = $_SESSION["actual_contact"]??0;
                $id = $_SESSION["id"]??0;
                $sql = "CALL sp_get_messeges($id, $actual_contact)";
                $html = "";
                $res = select($oCon, $sql);

                foreach($res as $item)
                {
                    if($item === end($res))
                    {
                        if($item["De"] == $id)
                        {
                            $html.= '
                            <div class="messege-self">
                                <div class="messege self">
                                    <div class="text-messege" id="last_messege">
                                        '.$item["Messege"].'
                                    </div>
                                    <div class="hour-messege">
                                        '.$item["Date"].'
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                        else if($item["De"] == $actual_contact)
                        {
                            $html.= '
                            <div>
                                <div class="messege">
                                    <div class="text-messege" id="last_messege">
                                        '.$item["Messege"].'
                                    </div>
                                    <div class="hour-messege">
                                        '.$item["Date"].'
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    }
                    else
                    {
                        if($item["De"] == $id)
                        {
                            $html.= '
                            <div class="messege-self">
                                <div class="messege self">
                                    <div class="text-messege">
                                        '.$item["Messege"].'
                                    </div>
                                    <div class="hour-messege">
                                        '.$item["Date"].'
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                        else if($item["De"] == $actual_contact)
                        {
                            $html.= '
                            <div>
                                <div class="messege">
                                    <div class="text-messege">
                                        '.$item["Messege"].'
                                    </div>
                                    <div class="hour-messege">
                                        '.$item["Date"].'
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    }
                }

                return $html;
            }
            
        }

        function add_messege($oCon, $messege, $date)
        {
            $id = $_SESSION["id"]??0;
            $actual_contact = $_SESSION["actual_contact"]??0;
            $sql = "CALL sp_add_messege($id, $actual_contact, '$messege', '$date')";

            $res = command($oCon, $sql);

            $sql_pending = "CALL sp_set_pending($id, $actual_contact, 1)";
            command($oCon, $sql_pending);

            return $res;
        }

        function get_contacts_by_input($oCon, $value)
        {
            $id = $_SESSION["id"]??0;
            $html = "";
            $sql = "CALL sp_get_contacts_by_input('%$value%')";

            if($value == "empty")
            {
                $sql = "CALL sp_get_all_contacts()";
            }

            $res = select($oCon, $sql);

            if(!empty($value))
            {
                if(is_array($res))
                {
                    if(!empty($res))
                    {
                        foreach($res as $item)
                        {
                            $user = $item["User"];
                            $id_contact = $item["Id"];
                            $gender = $item["Gender"];

                            $res_relationship = select($oCon, "CALL sp_get_relationship($id, $id_contact)");

                            if($id != $id_contact)
                            {
                                if(is_array($res_relationship))
                                {
                                    if(!empty($res_relationship))
                                    {
                                        if($gender == 1)
                                        {
                                            $html .= '
                                            <div class="result">
                                                <div class="c-img-result">
                                                    <img src="../img/hombre.jpg" alt="Private-img">
                                                </div>
                                                <div class="user-result">
                                                    <h1>
                                                        '.$user.'
                                                    </h1>
                                                </div>
                                                <div class="c-btn-result btn-red" title="Eliminar relación" data-value="'.$id.'-'.$id_contact.'-amigos">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-slash-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M11.354 4.646a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            ';
                                        }
                                        else if($gender == 2)
                                        {
                                            $html .= '
                                            <div class="result">
                                                <div class="c-img-result">
                                                    <img src="../img/mujer.webp" alt="Private-img">
                                                </div>
                                                <div class="user-result">
                                                    <h1>
                                                        '.$user.'
                                                    </h1>
                                                </div>
                                                <div class="c-btn-result btn-red" title="Eliminar relación" data-value="'.$id.'-'.$id_contact.'-amigos">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-slash-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M11.354 4.646a.5.5 0 0 0-.708 0l-6 6a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            ';
                                        }
                                    }
                                    else
                                    {
                                        if($gender == 1)
                                        {
                                            $html .= '
                                            <div class="result">
                                                <div class="c-img-result">
                                                    <img src="../img/hombre.jpg" alt="Private-img">
                                                </div>
                                                <div class="user-result">
                                                    <h1>
                                                        '.$user.'
                                                    </h1>
                                                </div>
                                                <div class="c-btn-result" title="Pedir relación" data-value="'.$id.'-'.$id_contact.'-noamigos">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            ';
                                        }
                                        else if($gender == 2)
                                        {
                                            $html .= '
                                            <div class="result">
                                                <div class="c-img-result">
                                                    <img src="../img/mujer.webp" alt="Private-img">
                                                </div>
                                                <div class="user-result">
                                                    <h1>
                                                        '.$user.'
                                                    </h1>
                                                </div>
                                                <div class="c-btn-result" title="Pedir relación" data-value="'.$id.'-'.$id_contact.'-noamigos">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            ';
                                        }
                                    }
                                }
                            }

                        }
                    }
                    else
                    {
                        $html = '<h1 style="text-align: center;">No se encontraron resultados<h1>';
                    }
                }
            }

            return $html;
        }

        function add_relationship($oCon, $id, $id_contact)
        {
            $sql = "CALL sp_create_relationship($id, $id_contact)";

            $res = command($oCon, $sql);

            return $res;
        }

        function delete_relationship($oCon, $id, $id_contact)
        {
            $sql1 = "CALL sp_delete_relationship($id, $id_contact)";
            $sql2 = "CALL sp_delete_relationship($id_contact, $id)";
            $res = "";
            $res .= command($oCon, $sql1);
            $res .= '-'.command($oCon, $sql2);

            return $res;
        }
    }

?>