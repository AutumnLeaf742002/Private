<?php

    class Contacts
    {
        public function get_contacts($oCon)
        {
            $id = $_SESSION["id"];
            $html = "";

            $sql = "CALL sp_get_contacts($id)";
            $res = select($oCon, $sql);

            if(is_array($res))
            {
                if(count($res) > 0)
                {
                    foreach($res as $item)
                    {
                        $sql_pending = 'CALL sp_get_pending('.$item["Id"].', '.$id.')';
                        $pending_res = select($oCon, $sql_pending);
                        $pending = $pending_res[0]["Pending"]??"0";

                        $last_messege_res = select($oCon, 'CALL sp_get_last_messege('.$item["Id"].', '.$id.')');
                        $last_messege = $last_messege_res[0]["Messege"]??"";

                        if($item["Gender"] == 1)
                        {
                            if($pending == 1)
                            {
                                if(!empty($_SESSION["actual_contact"]))
                                {
                                    if($_SESSION["actual_contact"] == $item["Id"])
                                    {
                                        $html.= '
                                        <div class="contact actual_contact" data-value="'.$item["Id"].'">
                                            <div class="c-img-contact">
                                                <img src="../img/hombre.jpg" alt="Private">
                                            </div>
                                            <div class="c-name-message">
                                                <h1 title="'.$item["User"].'">
                                                    '.$item["User"].'
                                                </h1>
                                                <p title="'.$last_messege.'">
                                                    '.$last_messege.'
                                                </p>
                                            </div>
                                            <div class="pending">

                                            </div>
                                        </div>
                                        ';
                                    }
                                    else
                                    {
                                        $html.= '
                                        <div class="contact" data-value="'.$item["Id"].'">
                                            <div class="c-img-contact">
                                                <img src="../img/hombre.jpg" alt="Private">
                                            </div>
                                            <div class="c-name-message">
                                                <h1 title="'.$item["User"].'">
                                                    '.$item["User"].'
                                                </h1>
                                                <p title="'.$last_messege.'">
                                                    '.$last_messege.'
                                                </p>
                                            </div>
                                            <div class="pending">

                                            </div>
                                        </div>
                                        ';
                                    }
                                }
                                else
                                {
                                    $html.= '
                                    <div class="contact" data-value="'.$item["Id"].'">
                                        <div class="c-img-contact">
                                            <img src="../img/hombre.jpg" alt="Private">
                                        </div>
                                        <div class="c-name-message">
                                            <h1 title="'.$item["User"].'">
                                                '.$item["User"].'
                                            </h1>
                                            <p title="'.$last_messege.'">
                                                '.$last_messege.'
                                            </p>
                                        </div>
                                        <div class="pending">

                                        </div>
                                    </div>
                                    ';
                                }
                            }
                            else
                            {
                                if(!empty($_SESSION["actual_contact"]))
                                {
                                    if($_SESSION["actual_contact"] == $item["Id"])
                                    {
                                        $html.= '
                                        <div class="contact actual_contact" data-value="'.$item["Id"].'">
                                            <div class="c-img-contact">
                                                <img src="../img/hombre.jpg" alt="Private">
                                            </div>
                                            <div class="c-name-message">
                                                <h1 title="'.$item["User"].'">
                                                    '.$item["User"].'
                                                </h1>
                                                <p title="'.$last_messege.'">
                                                    '.$last_messege.'
                                                </p>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    else
                                    {
                                        $html.= '
                                        <div class="contact" data-value="'.$item["Id"].'">
                                            <div class="c-img-contact">
                                                <img src="../img/hombre.jpg" alt="Private">
                                            </div>
                                            <div class="c-name-message">
                                                <h1 title="'.$item["User"].'">
                                                    '.$item["User"].'
                                                </h1>
                                                <p title="'.$last_messege.'">
                                                    '.$last_messege.'
                                                </p>
                                            </div>
                                        </div>
                                        ';
                                    }
                                }
                                else
                                {
                                    $html.= '
                                    <div class="contact" data-value="'.$item["Id"].'">
                                        <div class="c-img-contact">
                                            <img src="../img/hombre.jpg" alt="Private">
                                        </div>
                                        <div class="c-name-message">
                                            <h1 title="'.$item["User"].'">
                                                '.$item["User"].'
                                            </h1>
                                            <p title="'.$last_messege.'">
                                                '.$last_messege.'
                                            </p>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                        }
                        else if($item["Gender"] == 2)
                        {
                            if($pending == 1)
                            {
                                if(!empty($_SESSION["actual_contact"]))
                                {
                                    if($_SESSION["actual_contact"] == $item["Id"])
                                    {
                                        $html.= '
                                        <div class="contact actual_contact" data-value="'.$item["Id"].'">
                                            <div class="c-img-contact">
                                                <img src="../img/mujer.webp" alt="Private">
                                            </div>
                                            <div class="c-name-message">
                                                <h1 title="'.$item["User"].'">
                                                    '.$item["User"].'
                                                </h1>
                                                <p title="'.$last_messege.'">
                                                    '.$last_messege.'
                                                </p>
                                            </div>
                                            <div class="pending">

                                            </div>
                                        </div>
                                        ';
                                    }
                                    else
                                    {
                                        $html.= '
                                        <div class="contact" data-value="'.$item["Id"].'">
                                            <div class="c-img-contact">
                                                <img src="../img/mujer.webp" alt="Private">
                                            </div>
                                            <div class="c-name-message">
                                                <h1 title="'.$item["User"].'">
                                                    '.$item["User"].'
                                                </h1>
                                                <p title="'.$last_messege.'">
                                                    '.$last_messege.'
                                                </p>
                                            </div>
                                            <div class="pending">

                                            </div>
                                        </div>
                                        ';
                                    }
                                }
                                else
                                {
                                    $html.= '
                                    <div class="contact" data-value="'.$item["Id"].'">
                                        <div class="c-img-contact">
                                            <img src="../img/mujer.webp" alt="Private">
                                        </div>
                                        <div class="c-name-message">
                                            <h1 title="'.$item["User"].'">
                                                '.$item["User"].'
                                            </h1>
                                            <p title="'.$last_messege.'">
                                                '.$last_messege.'
                                            </p>
                                        </div>
                                        <div class="pending">

                                        </div>
                                    </div>
                                    ';
                                }
                            }
                            else
                            {
                                if(!empty($_SESSION["actual_contact"]))
                                {
                                    if($_SESSION["actual_contact"] == $item["Id"])
                                    {
                                        $html.= '
                                        <div class="contact actual_contact" data-value="'.$item["Id"].'">
                                            <div class="c-img-contact">
                                                <img src="../img/mujer.webp" alt="Private">
                                            </div>
                                            <div class="c-name-message">
                                                <h1 title="'.$item["User"].'">
                                                    '.$item["User"].'
                                                </h1>
                                                <p title="'.$last_messege.'">
                                                    '.$last_messege.'
                                                </p>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    else
                                    {
                                        $html.= '
                                        <div class="contact" data-value="'.$item["Id"].'">
                                            <div class="c-img-contact">
                                                <img src="../img/mujer.webp" alt="Private">
                                            </div>
                                            <div class="c-name-message">
                                                <h1 title="'.$item["User"].'">
                                                    '.$item["User"].'
                                                </h1>
                                                <p title="'.$last_messege.'">
                                                    '.$last_messege.'
                                                </p>
                                            </div>
                                        </div>
                                        ';
                                    }
                                }
                                else
                                {
                                    $html.= '
                                    <div class="contact" data-value="'.$item["Id"].'">
                                        <div class="c-img-contact">
                                            <img src="../img/mujer.webp" alt="Private">
                                        </div>
                                        <div class="c-name-message">
                                            <h1 title="'.$item["User"].'">
                                                '.$item["User"].'
                                            </h1>
                                            <p title="'.$last_messege.'">
                                                '.$last_messege.'
                                            </p>
                                        </div>
                                    </div>
                                    ';
                                }
                            }
                        }
                        else
                        {
                            $html.= '
                            <div class="contact">
                                <h1>Error en condicional.</h1>
                            </div>
                            ';
                        }
                    }
                }
                else
                {
                    $html.= '
                            <div class="contact-empty">
                                <h1 style="font-size: 18px; text-align: center; width: 100%;">No tienes contactos. Prueba agregar a alguien</h1>
                            </div>
                        ';
                }
            }

            return $html;
        }

        public function set_profile($oCon)
        {
            $user = $_SESSION["user"];
            $password = $_SESSION["password"];
            $sql = "CALL sp_login('$user', '$password')";
            $html = "";
            
            $res = select($oCon, $sql);

            if(is_array($res))
            {
                if(count($res) > 0)
                {
                    if($res[0]["Gender"] == 1)
                    {
                        $html = '
                        <div class="c-img">
                            <img src="../img/hombre.jpg" alt="Private">
                        </div>
                        <h1 title="'.$res[0]["User"].'">
                            '.$res[0]["User"].'
                        </h1>
                    ';
                    }
                    else if($res[0]["Gender"] == 2)
                    {
                        $html = '
                        <div class="c-img">
                            <img src="../img/mujer.webp" alt="Private">
                        </div>
                        <h1 title="'.$res[0]["User"].'">
                            '.$res[0]["User"].'
                        </h1>
                    ';
                    }
                    
                }
            }

            return $html;
        }
    }

?>