<?php

function save_mess(){
    
    global $db;
    if(isset($db)){
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $text = mysqli_real_escape_string($db, $_POST['txt']);
    $query = "INSERT INTO comments (name, text) VALUES ('$name','$text')";
    mysqli_query($db, $query);
    }
    
} 

function get_mess(){
    global $db;
    $query = "SELECT * FROM comments ORDER BY id DESC";
    $res = mysqli_query($db, $query);
    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}



?>
