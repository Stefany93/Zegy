<?php

function is_hash($a) 
{
    foreach(array_keys($a) as $key)
        if (!is_int($key)) return TRUE;
    return FALSE;
}
function buildQueryString($hash)
{
    if(is_hash($hash))
    {
        return http_build_query($hash);
    }else 
    {
        echo 'You must pass an hash to the buildQueryString function!';
    }    
}

$hash  = array('topic_Id' =>  2, 'id' => 1 );
echo buildQueryString($hash);