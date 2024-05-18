<?php  

function checkifExist($email,$con){
    $sql = $con->prepare("SELECT count(*) FROM users where email=?");
    $sql->execute([$email]);
    $stm=$sql->fetchColumn();
    return $stm==1;
    
}

function redirect($loc){
    return header("Location:$loc");
}

function getExten($name){
    return (substr($name,strpos($name,'/')+1,strlen($name)));

}
function isAuth($email,$pwd,$con){
    $sql = $con->prepare("SELECT count(*) FROM users where email=? AND password=?");
    $sql->execute([$email,$pwd]);
    $stm=$sql->fetchColumn();
    return $stm==1;

}


?>