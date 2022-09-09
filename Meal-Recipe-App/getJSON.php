<?php

if(isset($_POST["url"])){
    getJSON($_POST["url"]);
}
function getJSON($url){
    header('Content-Type: application/json');
    $json = file_get_contents($url);
    echo $json;

}
?>