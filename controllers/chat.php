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

            return $html;
        }

        public function get_messeges($oCon)
        {
            $actual_contact = $_SESSION["actual_contact"]??0;
            $id = $_SESSION["id"]??0;
            $sql = "CALL sp_get_messeges($id, $actual_contact)";
            $html = "";
            $res = select($oCon, $sql);

            foreach($res as $item)
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

            return $html;
        }
    }

?>