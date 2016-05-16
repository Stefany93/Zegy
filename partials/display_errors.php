<?php

if( empty($validate->getMissing()) )
{
    if( empty($validate->getErrors)  )
    {   
         $yield;
    }else
         {
             foreach ($validate->getErrors() as $error)
             {
                 printf('<p class="error"> %s </p>', htmlentities($error) );
             }
         }    
}else
{
    foreach ($validate->getMissing() as $missing)
             {
                 printf('<p class="error"> %s </p>', htmlentities($missing) );
             }
}

?>