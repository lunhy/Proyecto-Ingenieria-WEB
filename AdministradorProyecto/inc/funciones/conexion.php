<?php
    $conn = new mysqli('localhost', 'root', '', 'admproject');

    if($conn->connect_error){
        echo $conn->connect_error;
    }

    $conn->set_charset('utf8');

?>