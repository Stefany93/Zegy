<?php
class StartDB
{
    public function DBConnect()
    {
        try
        {
            $db = new PDO('sqlite:db/historiatalk');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }catch(PDOException $e)
        {
            printf("%s  %s", $e->getMessage(), __FILE__);
        }
    }
       
}
