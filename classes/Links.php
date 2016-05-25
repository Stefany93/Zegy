<?php
    class Links
    {

        public static function makeLink($page, $values, $title)
        {
                if(is_array($values))
                {    
                    foreach ($values as $value ) 
                    {
                        $value = self::cleanUrl($value);
                        $page .= "/$value";    
                    }
                }else
                {
                    $page  .="/$values";
                }
                return sprintf("<a href='%s'> %s </a>", $page, $title);
           
        }
        public static function cleanUrl($url)
        {
            $pattern = array('/[^a-z0-9\s]/i', '/\s/');
            $replacements = array('', '-');
            $subject = $url;
            return strtolower(preg_replace($pattern, $replacements, $subject));
        }
    }
