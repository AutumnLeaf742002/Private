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
    }

?>