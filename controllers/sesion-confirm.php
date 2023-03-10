<?php

    if(!empty($_POST))
    {
        session_start();
        if(!empty($_SESSION))
        {
            echo "true";
            $_SESSION["actual_contact"] = "";
        }
        else
        {
            echo "false";
        }
    }

?>