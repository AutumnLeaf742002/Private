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
                        <div id="c-search" class="c-search">
                            <input id="input-search" class="input-search input" type="text" placeholder="Buscar">
                            <div onclick="hide_search()">
                                <svg id="svg-quit" class="svg-quit" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                                </svg>
                            </div>
                        </div>

                        <div class="c-img">
                            <img src="../img/mujer.webp" alt="Private">
                        </div>
                        <h1 title="'.$res[0]["User"].'">
                            '.$res[0]["User"].'
                        </h1>
                        <div onclick="show_search()">
                            <svg id="search" class="search" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                        </div>
                    ';
                    }
                    
                }
            }

            return $html;
        }
    }

?>