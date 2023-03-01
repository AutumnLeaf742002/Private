<?php

    if(!empty($_POST))
    {
        session_start();
        if(!empty($_SESSION))
        {
            echo "true";
        }
        else
        {
            echo "false";
        }
    }

?>