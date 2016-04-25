<?php




try 
{
    $f = new CommonQueries();
    echo '<pre>';
    var_dump( $f->fetchOneRowWithCond('id', '1', '>'));
    echo '</pre>';
}catch(Exception $e)
{
    printf("%s  %s", $e->getMessage(), __FILE__);
}
