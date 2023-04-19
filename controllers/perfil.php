<?php

    class Perfil
    {
        public function get_data_user($oCon)
        {
            $id = $_SESSION["id"] ?? 0;
            $sql = "CALL sp_get_contact_chat($id)";
            $res = select($oCon, $sql);
            $values = "";

            if(is_array($res))
            {
                if(count($res) == 1)
                {
                    $values = $res[0]["User"].'/'.$res[0]["Gender"];
                }
            }

            return $values;
        }

        public function update_user($oCon, $user, $password, $gender)
        {
            $id = $_SESSION["id"] ?? 0;
            $sql = "";

            if($password == "not_password")
            {
                $sql = "UPDATE users SET User = '$user', Gender = $gender WHERE Id = $id";   
            }
            else
            {
                $password = encrypt($password);
                
                $sql = "UPDATE users SET User = '$user', Password = '$password', Gender = $gender WHERE Id = $id";

                $_SESSION["password"] = $password;
            }

            $res = command($oCon, $sql);

            return $res;
        }
    }

?>