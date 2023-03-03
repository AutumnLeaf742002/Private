<?php

    class Login
    {
        public function login_user($user, $password, $oCon)
        {
            $sql = "CALL sp_login('$user', '$password')";
            $res = select($oCon, $sql);

            $user_db = "";
            $password_db = "";
            $con = false;

            if(is_array($res))
            {
                if(count($res) > 0)
                {
                    $user_db = $res[0]["User"];
                    $password_db = $res[0]["Password"];

                    if($user_db != "" && $password_db != "")
                    {
                        if($user_db == $user && $password_db == $password)
                        {
                            $con = true;
                            $_SESSION["user"] = $user_db;
                            $_SESSION["id"] = $res[0]["Id"];
                            $_SESSION["password"] = $password_db;
                        }
                        else
                        {
                            $con = false;
                        }
                    }
                }
            }

            return $con;
        }
    }

?>