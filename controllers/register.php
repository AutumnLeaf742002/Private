<?php

    class Register
    {
        public function create_user($user, $password, $gender, $oCon)
        {
            $sql = "CALL sp_create_user('$user', '$password', $gender)";
            $res = command($oCon, $sql);

            return "$res";
        }
    }

?>