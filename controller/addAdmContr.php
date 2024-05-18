<?php

require_once('../model/user.php');

if (isset($_POST['new_adme'])) {
    $email = $_POST['new_adme'];
    $tel = $_POST['new_admtel'];
    if(user::addNewAdmin($email,$tel)){
    header('Location:../views/admin?msg=new admin added');
    }else{
        header('Location:../views/admin?msg=failed to add new admin ');
    }

    
}


?>