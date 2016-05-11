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
                return htmlentities($_SESSION[$sessionName]);
            }
       }
       public static function rememberInput($inputName)
       {
          if(isset($_POST[$inputName]))
          {
            return htmlentities($_POST[$inputName]);
          }else
          {
            return '';
          }
       }
    }
