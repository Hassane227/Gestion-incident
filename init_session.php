<?php


function session() : bool {


    if(!session_id()){
        session_start();
        session_regenerate_id();
        return true;
    }
    
    return false;
    
}
function is_login() : bool {
   return true; 
}

function detruir_session() : void {
    session_unset();
    session_destroy();
    
}
function is_admin(): bool{
    return true;
}
?>