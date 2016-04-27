<?php
    class Session
    {
       public static function set($sessionName, $value)
       {
            return $_SESSION[$sessionName] = $value;
       }
       public static function get($sessionName)
       {
            if( !isset($_SESSION[$sessionName]) )
            {
                throw new Exception("No such session name exists! >> ".$sessionName. " <<");
            }else
            {       
                return $_SESSION[$sessionName];
            }
       }
    }
