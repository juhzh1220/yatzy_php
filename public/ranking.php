<?php

session_start();

for ($i=0;$i<10;$i++){
    echo json_encode( $_SESSION["res"][$i]);
}








    
    
