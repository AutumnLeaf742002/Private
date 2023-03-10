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
    }

?>